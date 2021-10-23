 //use for ASSETS
 async function loadJSONdata(url, method) {
    const response = await fetch(url, {
    method: method
  });
    const data = await response.json();
    return data;
  }



/* 
  loadAPIdata('listings-api.php','GET').then(data => {
    document.getElementsByTagName("main")[0].innerHTML = data;
}); */