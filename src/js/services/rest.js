/* Clase de Servicio para llamadas AJAX */
export class Rest {
  static get(url, params, callback) {
    let paramsGET = '?';
    for (let param in params) {
      paramsGET += param + '=';
      paramsGET += params[param] + '&';
    }

    fetch(url + paramsGET.substring(0, paramsGET.length - 1))
      .then(response => {
        const status = response.status;
        return { responseStatus: status, responseText: response.text() , method: 'GET'};
      })
      .then(data => {
          
        if (callback) {
          data.responseText.then(texto => {
              callback(data.responseStatus, texto,data.method);
          }
      )}
      });
  }
  
  static post(url, params, callback) {
    const requestOptions = {
      method: 'POST',
      body: JSON.stringify(params),
      headers: { 'Content-Type': 'application/json' }
    };
  
    fetch(url, requestOptions)
      .then(response => {
        const status = response.status;
        return { responseStatus: status, response: response.json(), method: 'POST' };
      })
      .then(data => {
        if (callback) {
          return data.response.then(jsonData => {
            callback(data.responseStatus, jsonData, data.method);
          });
        }
      })
      .catch(error => console.error('Error:', error));
  }
  }