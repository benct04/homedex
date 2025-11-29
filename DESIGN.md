System overview:
My system is a home item management system called Homedex. It makes keeping track of your home items easier. My system allows users to login, add items, edit items, and delete items.

Class structure:
My system uses a local server to access databases using PHP. Since my system doesn’t have python, my SQL databases are my classes. I have a user’s class that keeps track of usernames and passwords. My other class is the items class. It 
keeps track of all of the user’s items data. 

Design Patterns:
In my PHP code I used a singleton pattern to make sure that duplicate users and items aren’t made. Additionally, I used a factory pattern to create new items in the items table using the html forms data.

Reflection:
During this process I have learned a lot about the importance of planning, implementation, and testing specifically in that order. Most of my previous projects were just an idea I started working on without much planning ahead of time. 
This caused a lot of challenges but for this prokect I saw the importance of planning and how it made the whole process smoother. Additionally, a testing phase that is detectated to not just making sure the system works in normal conditions
but that it will work on the edge cases proved very useful in finding bugs I never would've thought about.
