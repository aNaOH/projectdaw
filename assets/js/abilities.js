var app = new Vue({
    el: '#app',
    data: function () {
        return {
            abilities: [],
            submitted: true,
        };
    },
  
    created: function() {
        this.fetchAbilities();
    },
  
    methods: {
        fetchAbilities: function() {
            var self = this;
            $.ajax({
                url: "/api/auth/abilities",
                method: "GET",
                success: function(response) {
                    self.submitted = false;
                    if (response && response.abilities && Array.isArray(response.abilities)) {
                        self.abilities = response.abilities;
                    } else {
                        self.abilities = [];
                    }
                },
                error: function(error) {
                    self.submitted = false;
                }
            });
        },
  
        submit: function() {
            // Lógica para el método submit
        }
    }
});
