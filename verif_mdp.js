
function check_mdp(){
  var mdp1 = document.getElementById('mdp1').value;
  var mdp2 = document.getElementById('mdp2').value;
  var label = document.getElementById('label_mdp');

  if(mdp1==mdp2){
    label.innerHTML="les deux mots de passe sont identique </br> </br>";
    label.className = "vert";
    return true;
  }
  else{
    label.innerHTML="les deux mots de passe sont différent </br> </br>";
    label.className="rouge";
    return false;
  }
}

function check_mdp_valider(){
  var mdp1 = document.getElementById('mdp1').value;
  var mdp2 = document.getElementById('mdp2').value;
  if(mdp1!=mdp2){
    alert("la confirmation du mot de passe est différente du mot de passe");
  return false;
  }
  else return true;
}
