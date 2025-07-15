import axios from "axios";
window.axios = axios;

// axios.defaults.baseURL = "http://api.skyclub.my.id/api";
axios.defaults.baseURL = "http://127.0.0.1:8000/api";

const token = localStorage.getItem("auth_token");
if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}
