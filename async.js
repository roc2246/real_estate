//  use for ASSETS
// eslint-disable-next-line no-unused-vars
async function loadJSONdata(url, action) {
  const response = await fetch(url, {
    method: action,
  });
  const data = await response.json();
  return data;
}
