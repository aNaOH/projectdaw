var app = new Vue({
    el: '#form1',
    data: function () {
      return {
        email : "",
        emailBlured : false,
        valid : false,
        submitted : false,
        password:"",
        passwordBlured:false,
        error:false,
        errorMessage:"",
      }
    },
  
    methods:{
  
      validate : function(){
        this.emailBlured = true;
        this.passwordBlured = true;
        if( this.validEmail(this.email) && this.validPassword(this.password)){
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
  
      submit : function(){
        this.validate();
        if(this.valid){
          if(this.error){
            app.errorMessage = ""
            app.error = false;
          }
          this.submitted = true;
          $.ajax({
            url: "/api/auth/login",
            method: "POST",
            data: {
              email: this.email,
              password: this.password
            },
            success: function (response) {
              window.location = "/";
            },
            error: function (error) {
              app.submitted = false;
              if(error.status == 401){
                app.errorMessage = "El correo o contraseña no coincide con nuestros registros";
              }
              else{
                app.errorMessage = "Algo ha ido mal... Prueba más tarde";
              }
              app.error = true;
            }
          });
        }
      }
    }
  });