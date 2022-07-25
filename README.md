# TechForum

## Overview

TechForum is an online forum through which users can discuss technology related subjects. My goal with this project was to improve my PHP (Laravel) skills.
Design was inspired by different designs around the web, but the code has been written by hand.

## Functionalities

* Registration and login
* Changing user profile attributes, such as avatar, username, location, signature...
* Sending user a notification when someone responded to his message or thread
* Overview of logged users past replies and threads
* Overview of topics and subtopics within a category
* Overview of threads within a topic
* Sorting and filtering threads
* Replying to a thread. User has a possibility to quote another reply and to attach images to his reply
* Quick search of all threads with suggested threads with similar name instantly showing

## Technologies

* HTML
* CSS (Sass)
* Javascript (jQuery)
* PHP (Laravel)

___

## Pages

### Home

![Alt text](public/assets/img/pages/home_1.png?raw=true "Home 1")
![Alt text](public/assets/img/pages/home_2.png?raw=true "Home 2")
![Alt text](public/assets/img/pages/home_3.png?raw=true "Home 3")

* Overview of categories, subcategories, amount of threads and responses within those threads and the last thread name within a category
* Thread search with suggestions instantly showing up

___

### Subcategories

![Alt text](public/assets/img/pages/subcategories.png?raw=true "Subcategories")

* Overview of subtopics. If a certain topic has subcategories, then by clicking that topic its subcategories will show up

___

### Topic

![Alt text](public/assets/img/pages/topic.png?raw=true "Topic")

* Overview of threads, total views, total replies and last reply within a thread
* Threads can be sorted by age, name and view count

___

### Thread

![Alt text](public/assets/img/pages/thread.png?raw=true "Thread")

* Overview of replies in a thread. Before sending a reply, a user can choose whether or not he wants to quote another reply. Next to the reply is basic information about the user who wrote the reply and attached images
* Replies are paginated (4 per page)

___

### Profile

![Alt text](public/assets/img/pages/profile.png?raw=true "Profile")

* Information about a user which can be changed

___

### Posts

![Alt text](public/assets/img/pages/posts.png?raw=true "Posts")

* Previous posts of a user. Type of post (reply or thread), what topic does it belong to, message, reply count and time of posting

___

### Notifications

![Alt text](public/assets/img/pages/notifications.png?raw=true "Notifications")

* If someone has responded to a reply or a thread of a user, that user is being notified

___

### Sign In

![Alt text](public/assets/img/pages/sign_in.png?raw=true "Sign In")

* Login page. User can login through sidebar, too

___

### Register

![Alt text](public/assets/img/pages/register.png?raw=true "Register")

* After registration, user is assigned with a basic avatar

___

### Search

![Alt text](public/assets/img/pages/search.png?raw=true "Search")

* Search results which contain a certain keyword within themselves are being shown to the user
