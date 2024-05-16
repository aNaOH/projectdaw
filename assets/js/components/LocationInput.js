const LocationInput = {
  props: {
    value: String
  },
  template: `
    <div>
      <input type="text" class="form-control" :value="inputValue" @input="handleInput" placeholder="Buscar localidad...">
      <div v-if="showSuggestions" class="list-group suggestions">
        <button v-for="(suggestion, index) in suggestions" :key="index" @click="selectSuggestion(suggestion)" class="list-group-item list-group-item-action">
          {{ suggestion.display_name }}
        </button>
      </div>
    </div>
  `,
  data() {
    return {
      inputValue: '', // Utilizaremos este valor para el input interno
      suggestions: [],
      showSuggestions: false // Variable para controlar la visibilidad de las sugerencias
    };
  },
  created() {
    // Cuando se crea el componente, sincronizamos el valor interno con el valor externo
    this.inputValue = this.value;
  },
  methods: {
    async handleInput(event) {
      this.inputValue = event.target.value;
      this.$emit('input', this.inputValue); // Emitimos el evento para sincronizar el valor externo
      if (!this.inputValue) {
        this.suggestions = [];
        this.showSuggestions = false; // Ocultar las sugerencias si no hay valor en el input
        return;
      }
      // Realizar una búsqueda utilizando la API de Nominatim
      const response = await fetch(`https://nominatim.openstreetmap.org/search?city=${this.inputValue}&country=España&format=json`);
      const data = await response.json();
      this.suggestions = data;
      this.showSuggestions = true; // Mostrar las sugerencias después de recibir la respuesta de la API
    },
    async selectSuggestion(suggestion) {
      this.inputValue = suggestion.display_name;
      this.$emit('input', this.inputValue); // Emitimos el evento para sincronizar el valor externo
      this.suggestions = [];
      this.showSuggestions = false; // Ocultar las sugerencias después de seleccionar una sugerencia
    }
  },
  watch: {
    value(newValue) {
      // Si el valor externo cambia, actualizamos el valor interno
      this.inputValue = newValue;
    }
  }
};
