import axios from 'axios';
import router from '../router'; // Adjust the path to your router file

// Create an Axios instance
const axiosInstance = axios.create({
  //baseURL: 'https://your-api-base-url.com', // Replace with your API base URL
  // You can add default headers here if needed
  // headers: {'Authorization': 'Bearer ' + token}
});

// Add a response interceptor
axiosInstance.interceptors.response.use(
  response => {
    // Return the response if it's successful
    return response;
  },
  error => {
    // Check if the error response has a status of 401
    if (error.response && error.response.status === 401) {
      // Redirect to the login page
      router.push('/login'); // Adjust the path to your login route
    }
    // Return the error response
    return Promise.reject(error);
  }
);

export default axiosInstance;
