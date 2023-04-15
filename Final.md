# Final Report

![edupol logo here](/img/eduPol_logo.PNG)

## General Development

### Questions

- What did your team build? Is its feature complete and running?
- How many of your initial requirements that your team set out to deliver did you actually deliver (a checklist/table would help to summarize)?  Were you able to deliver everything or are there things missing?  Did your initial requirements sufficiently capture the details needed for the project?
- What is the architecture of the system?  What are the key components?   What design patterns did you use in the implementation?  This needs to be sufficiently detailed so that the reader will have an understanding of what was built and what components were used/created.  You will need to reflect on what you planned to build vs what you built.
- What degree and level of re-use was the team able to achieve and why?
- How many tasks are left in the backlog?

### Answers

- Our team built an iClicker clone named EduPol, which aims to improve student engagement and facilitate real-time feedback for instructors during classes. Although we have managed to complete several of our planned requirements, some features are still missing from our initial plans or not working quite as intended.

- Requirements completed
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

- Edupol uses a three tier web architecture, incorporating client, server and database systems. Our database system is containerized with Docker in order to deploy our system with all their dependencies into isolated containers. Docker also containerizes our PHP Ratchet Websocket, which facilitates real-time communication between users. Finally, our client are the user's local systems interacting with the system through their web browsers. The Ratchet PHP websocket is our implementation of the Observer Design pattern to allow teachers to be notified of student's change in behavior.

- Our team was able to use some software reuse for login and create account server and client side validation from previous projects we have completed that were also web-based.

- We have some final styling, site security and routing left in the backlog as well as being able to display a students total grade when they are in a live class.

## CI/CD

### Questions

- What testing strategies did you implement?  Comment on their degree of automation and the tools used.    Would you (as a team) deal with testing differently in the future?  Make sure to ensure that your testing report is updated to reflect what's actually been done.  Has
- How did your branching workflow work for the team?  Were you successful in properly reviewing the code before merging as a team?
- How would your project be deployed?  Is it docker ready and tested?  Provide a brief description of the level of dockerization you have implemented and what would be required to deploy.

### Answers

- Our team primarily employed manual and integration testing, as the project's structure did not lend itself well to more automated testing processes. When a task or feature was completed, we first performed manual testing using dummy variables to verify correct functionality with the database and appropriate client-side page responses. Subsequently, we conducted integration and system testing to ensure seamless operation with the rest of the system, including the accurate passing of variables from POST/GET requests and session management. In future projects, our team would consider adopting a more modular structure to facilitate greater testing automation and improve overall testing efficiency.
- The branching workflow was highly effective for our team. Each feature was developed on its own branch, with tasks organized into related categories (teacher portal, student portal, and quizzes) to prevent team members from working on the same files simultaneously. This approach minimized merge conflicts and streamlined the integration process. Additionally, our close proximity as roommates allowed for efficient code review and coordination during the merging process.
- Our project is designed for deployment using Docker, and it has been tested to ensure compatibility with Windows and Mac OS. The implementation level of Dockerization streamlines the deployment process and provides a consistent environment for development among our team members. To deploy the project, a user would simply need to clone the repository, ensure they have Docker installed, and run docker-compose up -d in the project directory to build and launch the containers in detached mode. This will allow users to run the system locally. To fully experiment with the system's functionalities, the user would have to run localhost in two different browsers or two different browser sessions of the same browser.

## Reflections

### Questions

- How did your project management work for the team?  What was the hardest thing and what would you do the same/differently the next time you plan to complete a project like this?
- Do you feel that your initial requirements were sufficiently detailed for this project?  Which requirements did you miss or overlook?
- What did you miss in your initial planning for the project (beyond just the requirements)?
- What process did you use (ie Scrum, Kanabn..), how was it managed, and what was observed? 
- As a team, did you encounter issues with different team members developing with different IDEs?  In the future, would the team change anything in regard to the uniformity of development environments?
- If you were to estimate the efforts required for this project again, what would you consider?  (Really I am asking the team to reflect on the difference between what you thought it would take to complete the project vs what it actually took to deliver it).   
- What did your team do that you feel is unique or something that the team is especially proud of (was there a big learning moment that the team had in terms of gaining knowledge of a new concept/process that was implemented).

### Answers

- Our project management and teamwork were effective, primarily due to our ability to communicate efficiently and address emerging issues. In-person communication was particularly advantageous, allowing us to rapidly address concerns and make adjustments as needed. The agile development process we adopted enabled our team to remain flexible and responsive to changes. Moving forward, we would continue utilizing this approach for similar projects, as it proved successful in promoting productive collaboration and effective problem-solving.
- While our initial requirements laid a strong foundation for the project, there were some oversights. These included the proper storage of responses, notification systems for students, and the presentation of questions. Although these missing requirements impacted our initial plan, we were still able to develop a functional polling system. In future projects, a more thorough requirements analysis would be beneficial in order to capture all essential functionalities and minimize unexpected challenges.
- Looking back, our planning process should have included a more comprehensive approach to styling and visual structure. A uniform naming convention for class and ID attributes, along with a consistent visual structure for all pages, would have significantly improved the clarity and maintainability of our CSS code. In future projects, incorporating a style guide and establishing design patterns early in the planning process would greatly enhance the final product's aesthetics and usability.
- We employed a Kanban-based development process, which was managed both in-person and through the repository's Projects tab. The Kanban board was divided into three views, corresponding to each development milestone outlined in the course project requirements. Tasks were assigned to team members, and priorities were set using a three-tiered system. This structured approach enabled us to efficiently allocate resources, manage priorities, and maintain a clear overview of our progress throughout the project. For future projects, we would continue refining our task management strategies to maximize efficiency and ensure timely completion of milestones.
- Our team successfully maintained a consistent development environment, with all members using Visual Studio Code. The Dockerization process further streamlined our workflow by facilitating seamless Continuous Deployment. For future projects, we would continue to emphasize the importance of uniform development environments and explore additional tools and technologies that can further enhance our development process.
- Our initial estimation of effort and resource allocation for the project was inadequate in certain areas, particularly in styling and real-time communication architecture. The implementation of asynchronous communication between teacher and student devices proved more challenging than anticipated. Moreover, the use of PHP complicated real-time communication between the server and clients, while setting up Docker containers demanded frequent re-initialization. In future projects, a more accurate estimation of effort and resources would involve identifying potential challenges early on and allocating sufficient time and resources to address them effectively.
- Our most significant learning experience and proudest accomplishment revolved around mastering WebSockets and real-time communication between clients. Although this aspect was initially underplanned, it ultimately led to a valuable and enriching learning opportunity. The experience underscored the importance of being adaptable and resourceful when confronting unexpected challenges. Despite falling behind schedule and not yet meeting all minimum requirements, our team has gained substantial knowledge and skills through the project. In future projects, we will apply these lessons to ensure continued growth and improvement in our development processes.

