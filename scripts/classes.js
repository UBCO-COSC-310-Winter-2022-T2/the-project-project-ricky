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