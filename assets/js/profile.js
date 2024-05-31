
if (document.getElementById('app')) {
    var app = new Vue({
        el: '#app',
        components: {
            'location-input': LocationInput
          },
        data: function () {
          return {
            valid : false,
            submitted : false,
            location:"",
            locationBlured:false,
            error:false,
            errorMessage:"",
          }
        },
      
        methods:{
      
            validate : function(){
                this.locationBlured = true;
                if(
                    this.validLocation(this.location)
                ){
                  this.valid = true;
                }
              },
      
            validLocation : function(location) {
                if (location.length > 0) {
                  return true;
                }
            },

            submit : function(){
                this.validate();
                if(this.valid){
                  this.submitted = true;
                  $.ajax({
                    url: "/api/auth/location",
                    method: "POST",
                    data: {
                      location: this.location,
                    },
                    success: function (data){
                      window.location = "/profile";
                    },
                    error: function (error) {
                      app.submitted = false;
                      app.errorMessage = "Algo ha ido mal... Prueba más tarde";
                      app.error = true;
                    }
                  });
                }
              }
        }
      });
}