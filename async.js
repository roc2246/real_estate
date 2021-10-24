 //use for ASSETS
 async function loadJSONdata(url, action) {
    const response = await fetch(url, {
    method: action,
  });
    const data = await response.json();
    return data;
  }

