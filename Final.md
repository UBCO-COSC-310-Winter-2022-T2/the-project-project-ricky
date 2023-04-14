# Final Report

[edupol logo here]

## General Development

Questions
- What did your team build? Is it feature complete and running?
- How many of your initial requirements that your team set out to deliver did you actually deliver (a checklist/table would help to summarize)?  Were you able to deliver everything or are there things missing?  Did your initial requirements sufficiently capture the details needed for the project?
- What is the architecture of the system?  What are the key components?   What design patterns did you use in the implementation?  This needs to be sufficiently detailed so that the reader will have an understanding of what was built and what components were used/created.  You will need to reflect on what you planned to build vs what you built.
- What degree and level of re-use was the team able to achieve and why?
- How many tasks are left in the backlog?

Answers
- Our team built an iClicker clone named EduPol ....

- Requiremnets competed 
  - The system will allow instructors to create and customize polls and quizzes which consist of multiple choice questions.
  - The system will allow instructors to write the answer and choose the correct answer which will be correctly stored in the database.
  - The system will protect student data and ensure anonymity from other students.
  - The system will allow students and instructors to create an account based on their respective roll.
  - The system will allow student users to join a class.
  - the system will allow instructors to create a class
  - the system will allow student users to answer polls/quizzes
  - the system will notify students when a class has started and allow them to participate
  - the system will display quiz questions on students screens when the instructor launches it
  - The system will notify instructors of student responses in real-time using the Observer design pattern. 

- Incomplete requirements 
  - The system will correctly record and store a students response to a question
  - The system will be able to correctly present and store a students total grade for a class.
  - The system will incorporate game elements to keep students engaged, such as a leaderboard with a top 10.
  - The system will allow instructors to send a personalized message per grade-range to students.
  - ?(The system should integrate with learning management systems like Canvas or Blackboard.) Not sure if this is realistic.


- Edupol uses a three tier web architecture, incorporating client, server and databse sytems. It is built with HTML, CSS, PHP, and javascript for the front and back ends and uses an observer pattern design pattern ....

- Our tema was able to use some software reuse for login and create account server and client side validation from previous projects we have completed that were also web-based. 

- We have some final styling, site security and routing left in the backlog as well as being able to display a students total grade when they are in a live class. 

## CI/CD
questions 
- What testing strategies did you implement?  Comment on their degree of automation and the tools used.    Would you (as a team) deal with testing differently in the future?  Make sure to ensure that your testing report is updated to reflect what's actually been done.  Has
- How did your branching workflow work for the team?  Were you successful in properly reviewing the code before merging as a team?
- How would your project be deployed?  Is it docker ready and tested?  Provide a brief description of the level of dockerization you have implemented and what would be required to deploy.
 
 Answers
 - Our team mainly used Manual and Integration testing as we really didnt have modules or functions that we could use a more automatted proccess for. Whenever a task or feature was completed we used manual testing with dummy variables to ensure correct functionality with the database and that the client side pages responded correctly. After passing those tests we then used integration and system testing to ensure proper functionality with the rest of the system. This mainly involved testing the system between related functionalities like the passing of variables from a post/get request as well as session variables. In the future our team would probably build the entire system differently, with an entirely different structure that would be based more on modules so we could achieve a higher level of testing automation.
 - The branching workflow worked really well, each feature was built on its own branch and we separated the tasks into related categories (teacher prtal, student portal, and quizzes) so no one had to work on the same file which lead to seemless merges with little to no conflicts. Also as our group members are all roommates it was easy and efficient to review and coordinate merging.
 - .......

## Reflections

questions
- How did your project management work for the team?  What was the hardest thing and what would you do the same/differently the next time you plan to complete a project like this? 
- Do you feel that your initial requirements were sufficiently detailed for this project?  Which requirements did you miss or overlook?
- What did you miss in your initial planning for the project (beyond just the requirements)?
- What process did you use (ie Scrum, Kanabn..), how was it managed, and what was observed? 
- As a team, did you encounter issues with different team members developing with different IDEs?  In the future, would the team change anything in regard to the uniformity of development environments?
- If you were to estimate the efforts required for this project again, what would you consider?  (Really I am asking the team to reflect on the difference between what you thought it would take to complete the project vs what it actually took to deliver it).   
- What did your team do that you feel is unique or something that the team is especially proud of (was there a big learning moment that the team had in terms of gaining knowledge of a new concept/process that was implemented).

Answers
- The project management worked well in general, again as we were able to communicate in person which is very efficient, especially since we used an agile process. As for a project management perspective, we would not do anything differently, we had great comunication and problem solving of arising issues that occured during the development.
- Our intital requirements were almost complete for what was actually needed. We did miss some requirements, however most of the basic function requirements were completed so the product can be used as an ungraded polling system. Are initial requirements did capture what was needed for the project but we were missing the requirements of correctly storing a response and notifying students screens of a started class and displaying questions.
- Styling for sure. We should have made a plan for class names and id's as well as page visual structures, this would have led to a much cleaner CSS system and less redundated and duplicated code. 
- We used a kanban process which was managed in person, and through the projects tab of the repository. The kanban board was filled with tasks for the project and each task that involved a feature of a system was linked to the pull requst when it was completed. All tasks were assigned group memebrs to complete, this was discussed in the original plan before start, and anything that was not covered was picked up and assigned on the spot. All tasks were also assigned a milestone tag of priority, priority one being minimal functional requirements, priority 2 being functional requirements like editting or deleteing, and priority 3 which was typcally visual items like styling or non functional requirements. We also had 3 views of the kanban board, one for each development milestone of the course project outline, and each having the added tasks to be done for that sprint. 
- We did not experince any issues with uniformity of development environmenst, all of us used VSCode and the Dockerization made it easy for CD.
- Our expected effort required for this project was definetly lacking in some areas. As already mentioned with the lack of planning for consistend styling accross all pages. The main difficulty we faced was the complexity of asychronous communication between the teacher and student devices to start class sessions and launch quizzes .... (talk about web sockets complexity and studff)
- ...

