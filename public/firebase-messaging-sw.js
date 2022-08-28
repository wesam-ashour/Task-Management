importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');



firebase.initializeApp({
    apiKey: "AIzaSyAfKlmgM8TO5SRAXCF6_hgGHuh3zomWf-M",
    authDomain: "push-c4003.firebaseapp.com",
    projectId: "push-c4003",
    storageBucket: "push-c4003.appspot.com",
    messagingSenderId: "362317081774",
    appId: "1:362317081774:web:003628d4761a981026d13f"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
