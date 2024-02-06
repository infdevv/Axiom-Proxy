
 
 // define the proxy for all the world to see
 function proxy(url){
             // call the proxy and display the result
 
             console.log("Connecting to proxy...")
 
             proxy_url = "https://axiomhub.net/main.php"
             
            
 
             fetch(proxy_url + "?url=" + url, {
     method: 'GET',
     headers: {
         'Content-Type': 'application/json',
         // You can add other headers if needed
     },
 })
     .then(response => {
         if (!response.ok) {
             throw new Error('Network response was not ok');
         }
         return response.text();  // or response.json() if the content is JSON
     })
     .then(data => {
         // Assuming "iframe" is an iframe element
         //var iframe = document.getElementById("iframe");
         filtered_data = data
         //filtered_data = data.replace("src=\"/",("src=\""+url+"/"))
         //filtered_data = filtered_data.replace("href=\"/",("href=\""+url+"/"))
 
         return filtered_data
     })
     .catch(error => {
         console.error('Fetch error:', error);
     });
 }
 
 // Starting escape keys
 
 document.addEventListener('keydown', function(event) {
   if (event.key === localStorage.getItem("escape")) {
     window.location=localStorage.getItem("site")
   }
 });
 
 function load_script(path){
     var script = document.createElement('script');
   
   script.src = path;
   
   document.head.appendChild(script);
 }
