
const center = { lat: 50.064192, lng: -130.605469 };
// Create a bounding box with sides ~10km away from the center point
const defaultBounds = {
  north: center.lat + 0.1,
  south: center.lat - 0.1,
  east: center.lng + 0.1,
  west: center.lng - 0.1,
};

const input = document.getElementById("pac-input");
const options = {
  bounds: defaultBounds,
  fields: ["address_components", "name"],
  strictBounds: false,
};

const autocomplete = new google.maps.places.Autocomplete(input, options);
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place =  autocomplete.getPlace();
    let adresse = "";
    place.address_components.forEach(element => {
            for (const Key in element) {
                if (Key == "types"){
                    switch (element[Key][0]) {

                        case "street_number":
                            adresse += element.long_name + " ";
                            break;
                        case "country":
                             document.getElementById('cli__pays').value = element.long_name
                            break;
                        case "route":
                            adresse += element.long_name;
                            break;
                        case "locality":
                            document.getElementById('cli__ville').value = element.long_name
                            break;
                        case "postal_code":
                            document.getElementById('cli__cp').value = element.long_name
                            break;
                    
                        default:
                            break;
                    }
                
                }
            }
            document.getElementById('cli__adr1').value =  adresse
            document.getElementById("pac-input").value = "";
            document.getElementById("cli__adr2").value = "";
    });
});
