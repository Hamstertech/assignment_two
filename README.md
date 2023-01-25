## Task 1 - Done

## Task 2 - Done

## Task 3 - Done

## Task 4 - Almost completed: 
- Didnt have time to complete it before submission. But the idea is that theres a select with the names of all the books, films and songs. The user then selects one, and all the artists that has a medium with that song will appear on the the list for inspection.

## Task 5 - Done

## Task 6 - TBD

# Local setup (Working on bugs)
- In the ".env" file "APP_URL" should contain the url to the local dev BUT without "http://" and "https://". The cause of this bug is that the vite.config.js file is using custom code to work with local named urls.

- Further more, add VITE_APP_URL="${APP_URL}" VITE_APP_SECURE="http://" (http for local https for production) and for this specific project, a "SECURITY_TOKEN" with whatever integer you want when registering users. 
