//To get live date, day and time
function updateClock() {
    // To get the current date and time
    var now = new Date();
  
    // To fet the hours, minutes, and seconds
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
  
    // To get the date components
    var year = now.getFullYear();
    var monthIndex = now.getMonth();
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var monthName = monthNames[monthIndex];
    var day = now.getDate();
  
    // To format the time string as hh:mm:ss
    var timeString = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
  
    // To format the date string as Month Day, Year
    var dateString = monthName + ' ' + day.toString().padStart(2, '0') + ', ' + year;
  
    // To update the clock and date elements with the formatted time and date strings
    document.getElementById("time").innerHTML = timeString;
    document.getElementById("date").innerHTML = dateString;
  }
  
  // Call the updateClock function once to set the initial time and date
  updateClock();
  
  // Refresh the clock and date every second using setInterval
  setInterval(updateClock, 1000);


// Function to update the weather data based on the city name
function updateWeatherData(cityName) {
  const API_KEY = '3a449ca4202378f373da2d6f18fbf37e'; 
  const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${cityName}&units=metric&appid=${API_KEY}`;

  fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
      // Update the HTML elements with the weather data
      document.querySelector('.temperature').innerHTML = `${Math.round(data.main.temp)}&deg;C`;
      document.querySelector('.time-zone').innerHTML = data.name;
      document.querySelector('.country').innerHTML = data.sys.country;
      document.querySelector('.weather-condition').innerHTML = data.weather[0].description;
      document.querySelector('.Humidity').innerHTML = `Humidity: ${data.main.humidity}%`;
      document.querySelector('.Rain-fall').innerHTML = `Rainfall: ${data.rain ? data.rain['1h'] : 0} mm`; // Check if rainfall data is available
      document.querySelector('.Wind-Speed').innerHTML = `Wind speed: ${data.wind.speed} m/s`;
      document.querySelector('.Pressure').innerHTML = `Pressure: ${data.main.pressure} hPa`;

      // Update the weather icon
      const weatherIcon = document.querySelector('.weather_icon');
      const iconUrl = `http://openweathermap.org/img/w/${data.weather[0].icon}.png`;
      weatherIcon.innerHTML = `<img src="${iconUrl}" alt="Weather icon">`;
    })
    .catch(error => {
      console.log(error);
      alert('Unable to retrieve weather data. Please try again.');
    });
}

// Call the updateWeatherData function with the default city name (Huntsville) when the page loads
updateWeatherData('Huntsville');

// Add event listener to the search button
const searchBtn = document.querySelector('button[type="submit"]');
const searchinput = document.querySelector('#search');

searchBtn.addEventListener('click', () => {
  const cityName = searchinput.value;
  updateWeatherData(cityName);
});

searchnput.addEventListener('keydown', (event) => {
  if (event.key === 'Enter') {
    const cityName = searchinput.value;
    updateWeatherData(cityName);
  }
});

//to change the background image according to conditions

function changeBackgroundImage(city) {
  // make API call to fetch weather data for the city
  fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=YOUR_API_KEY`)
    .then(response => response.json())
    .then(data => {
      // get the weather condition from the API response
      const weatherCondition = data.weather[0].main.toLowerCase();

      // set the background image based on the weather condition
      switch (weatherCondition) {
        case 'clear':
          document.getElementById('background').src = 'clear.jpg';
          break;
        case 'clouds':
          document.getElementById('background').src = 'cloudy.jpg';
          break;
        case 'rain':
          document.getElementById('background').src = 'rainy.jpg';
          break;
        case 'snow':
          document.getElementById('background').src = 'snowy.jpg';
          break;
        default:
          document.getElementById('background').src = 'default.jpg';
      }
    })
    .catch(error => console.log(error));
}

// call the changeBackgroundImage function when the page loads
window.onload = () => {
  changeBackgroundImage('Huntsville');
};

const searchInput = document.getElementById('search');
const cityImage = document.querySelector('.cityimage img');

// Function to fetch city image from Pexels API
async function fetchCityImage(city) {
  const apiKey = 'lE48G6WED7cuQUfGoeKew6Z89Adg9rHEg17kvtimukM1ChAsE3yrDyIl';
  const url = `https://api.pexels.com/v1/search?query=${city}&per_page=1`;
  const response = await fetch(url, {
    headers: {
      Authorization: apiKey,
    },
  });
  const data = await response.json();
  return data.photos[0].src.medium;
}

// Event listener for search input
searchInput.addEventListener('change', async (event) => {
  const city = event.target.value;
  const imageUrl = await fetchCityImage(city);
  cityImage.src = imageUrl;
});

