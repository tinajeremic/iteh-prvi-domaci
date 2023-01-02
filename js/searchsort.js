// pretrazivanje
$("#pretraga").on("keyup", function () {
    let unos = $(this).val();
    let filter = unos.toLowerCase();
    let objekti = $(".col");
    console.log(objekti);
  
    for (let i = 0; i < objekti.length; i++) {
      let vidljivost = false;
  
      let naslov = objekti[i].getElementsByTagName("h5")[0];
      let paragrafi = objekti[i].getElementsByTagName("p");
  
      let niz = [];
      niz.push(naslov);
      for (let j = 0; j < paragrafi.length; j++) {
        niz.push(paragrafi[j]);
      }
  
      for (let j = 0; j < niz.length; j++) {
        if (niz[j]) {
          unos = niz[j].textContent || niz[j].innerText;
          if (unos.toLowerCase().indexOf(filter) > -1) {
            vidljivost = true;
          }
        }
      }
  
      if (vidljivost) {
        objekti[i].style.display = "";
      } else {
        objekti[i].style.display = "none";
      }
    }
  });