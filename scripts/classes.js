function showSuggestions(str) {
    if (str.length === 0) {
      document.getElementById("suggestions").innerHTML = "";
      document.getElementById("suggestions").style.display = "none";
      return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        if (this.responseText) {
          document.getElementById("suggestions").innerHTML = this.responseText;
          document.getElementById("suggestions").style.display = "block";
        } else {
          document.getElementById("suggestions").innerHTML = "";
          document.getElementById("suggestions").style.display = "none";
        }
      }
    };
    xmlhttp.open("GET", "../routes/getSuggestions.php?search=" + encodeURIComponent(str), true);
      xmlhttp.send();
    }

    function selectSuggestion(school) {
      document.getElementById("search").value = school;
      document.getElementById("suggestions").innerHTML = "";
      document.getElementById("suggestions").style.display = "none";
    }

    function showSuggestions2(str){
      if(str.length=== 0){
          document.getElementById("suggestions2").innerHTML = "";
          document.getElementById("suggestions2").style.display = "none";
      }
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function(){
          if(this.readyState === 4 && this.status === 200){
              if(this.responseText){
                  document.getElementById("suggestions2").innerHTML = this.responseText;
                  document.getElementById("suggestions2").style.display = "block";
              } else{
                  document.getElementById("suggestions2").innerHTML = "";
                  document.getElementById("suggestions2").style.display = "none";
              }
          }
      };
      var school = document.getElementById("hidden-school").value;
      xmlhttp.open("GET", "../routes/getSuggestions2.php?school="+encodeURIComponent(school)+"&search="+encodeURIComponent(str), true);
      xmlhttp.send();
      
  }
  function selectSuggestion2(cname){
      document.getElementById("search").value=cname;
      document.getElementById("suggestions2").innerHTML = "";
      document.getElementById("suggestions2").style.display="none";
  }