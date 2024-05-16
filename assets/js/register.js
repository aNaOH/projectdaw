var app = new Vue({
    el: '#form1',
    components: {
      'location-input': LocationInput
    },
    data: function () {
      return {
        email : "",
        emailBlured : false,

        name : "",
        nameBlured : false,
        familyName : "",
        familyNameBlured : false,

        password:"",
        passwordBlured:false,
        passwordConfirm:"",
        passwordConfirmBlured:false,

        location:"",
        locationBlured:false,

        valid : false,
        submitted : false,
        
        error:false,
        errorMessage:"",
      }
    },
  
    methods:{
  
      validate : function(){
        this.emailBlured = true;
        this.passwordBlured = true;
        this.passwordConfirmBlured = true;
        this.locationBlured = true;
        this.nameBlured = true;
        this.familyNameBlured = true;
        if(
            this.validEmail(this.email) &&
            this.validPassword(this.password) &&
            this.validPasswordConfirm(this.password, this.passwordConfirm) &&
            this.validLocation(this.location) &&
            this.validName(this.name) &&
            this.validFamilyName(this.familyName)
        ){
          this.valid = true;
        }
      },
  
      validEmail : function(email) {
        
        var re = /(.+)@(.+){2,}\.(.+){2,}/;
        if(re.test(email.toLowerCase())){
          return true;
        }
      
      },
  
      validPassword : function(password) {
        if (password.length > 7) {
          return true;
        }
      },

      validPasswordConfirm : function(password, passwordConfirm) {
        if (password == passwordConfirm) {
          return true;
        }
      },

      validLocation : function(location) {
        if (location.length > 0) {
          return true;
        }
      },

      validName : function(name) {
        if (name.length > 0) {
          return true;
        }
      },

      validFamilyName : function(familyName) {
        if (familyName.length > 0) {
          return true;
        }
      },
  
      submit : function(){
        this.validate();
        if(this.valid){
          if(this.error){
            app.errorMessage = ""
            app.error = false;
          }
          this.submitted = true;
          $.ajax({
            url: "/api/auth/register",
            method: "POST",
            data: {
              email: this.email,
              name: this.name,
              familyName: this.familyName,
              location: this.location,
              password: this.password
            },
            success: function (data){
              window.location = "/login";
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