// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import 'firebase/messaging'

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCcgLrbu8g3Zfb1coNGQjhpNuCO_8gC9fg",
    authDomain: "blink-safety.firebaseapp.com",
    projectId: "blink-safety",
    storageBucket: "blink-safety.appspot.com",
    messagingSenderId: "163588202431",
    appId: "1:163588202431:web:acb984cb3b07f5d3638b0a"
};
const firebaseApp = initializeApp(firebaseConfig)
export default firebaseApp;
