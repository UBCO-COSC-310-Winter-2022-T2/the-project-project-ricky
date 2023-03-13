# Milestone #2 - Project Description and Requirements

## Description

The project our team is approaching is the iClicker clone.

The goal of this project is to develop a web-based platform that will allow instructors to perform real-time polling and receive instant feedback from students. This platform will evidently be modeled after the iClicker service but improve on some of its features to give instructors more flexibility in questions.

The platform will temporarily be referred to as EduPoll until the team comes up with a better name. EduPoll will only support multi-choice question as its goal is to enable fast,real-time, in-class asssessment to keep students engaged and test their knowledge. In order for instructors to be able to view student responses in real-time, the system will integrate the Behavioural Observer Pattern that defines a relationship between objects where a subject object maintains a list of its dependents observers. This will allow instructors to be notified automatically of any state changes when students answer.

Furthermore, EduPoll will be created using a microservice architecture, thus broken down into smaller, independent services interacting with each other using APIs. In order for the system to support a SOA architecture, it will incorporate the structural facade design pattern in order to provide a simplified interface between the users and the underlying system.

In order for students to feel compelled to interact without the fear of being wrong, student's usernames will only be viewable by the instructor to preserve anonymity.

## Requirements analysis and development

### Proto-persona for user

![mj](img/personamj.png)
*please excuse the watermark

Name: Michael Jordan

Age: 37

Education: PhD in Chemistry

Family Status: Married

Job Title: Head of the chemistry department at UBC

Background: Michael has had a brilliant academic career and got his phD young at only 25. He since has been teaching at large universities for over a decade. Being so young, he considers himself a tech-savyy and stays up to date with recent technologies. As his peers consider him a pioneer in his field, he is always looking for new ways to enhance his student's learning experiences.

Goals: Professor Jordan's goal is to foster his student's love for chemistry and suceed in his classes. He wants to make sure the lectures are engaging and that his students are able to understand and apply the material they are learning. He has long been looking for a way to continuously assess students in class not for grades but for learning.

How will Michael Jordan interact with EduPoll: Michael would like the platform to be very customizable, he would like to be able to share his screen while starting his questions or upload a pre-set image to his questions so that his students can see the question on their screen. He would also like to be able to visualize his students answer in real-time as people are answering the poll. His ultimate goal is to identify student's gap of knowledge and adapt his lectures and cursus accordingly.

### Journey-line

Again this is not final and temporary. Mac if you can make all these steps into a nice journey line diagram please

1. Professor Jordan introduces the EduPoll platform to his students at the beginning of the year and explains how it will be used throughout the year as a continously graded assessment.
2. During lectures, he tries to fit at least 5 EduPoll questions to his students in the platform, always related to what they're currently studying and chronologically logical.
3. If all the students answer correctly, Michael distributes candies or chocolates in the class as an incentive for learning.
4. As the system keeps every student as an object, Michael does not have to manually increment each student's score.
5. After the lecture, he reviews the class polls and takes notes about what to review in his review sessions before each of his 3 midterms.
6. As the semester progresses, Michael notices that his students are becoming more engaged and motivated in class, thanks to EduPoll.
7. At the end of the semester, Professor Jordan is able to set an automatic message per grade range through the EduPoll system to congratulate/inform students of their grade.
8. Michael is pleased with the system and plans on using it for his other classes.

### Functional Requirements

- The system will allow instructors to create and customize polls and quizzes which consist of multiple choice questions.
- The system will allow instructors to either share their screens or have a pre-set written or image question.
- The system will notify instructors of student responses in real-time using the Observer design pattern.
- The system will be able to correctly present and store a students total grade for a class.
- The system will incorporate game elements to keep students engaged, such as a leaderboard with a top 10.
- The system will allow instructors to send a personalized message per grade-range to students.
- ?(The system should integrate with learning management systems like Canvas or Blackboard.) Not sure if this is realistic.
- The system will protect student data and ensure anonymity from other students.
- The system will allow students and instructors to create an account based on their respective roll.
- The system will allow student users to join a class.
- the system will allow instructors to create a class
- the system will allow studnet users to answer polls/quizes

### Non-functional Requirements

- The system should allow instructors to launch polls and quizzes quickly and easily during class.
- The system should have instant-response time(less than 2s will do) for student's response.
- The system should be accessible from different browsers and devices.
- The system must not disclose any personal information about students and instructors apart from their name.
- The system should be scalable and open to future improvements, such as add short answer questions, matching questions or ranking quizzes.

## Use Cases

#### Use Case 1. Create Account

Primary actor: Student, Instructor, Database

Description: The Instructor and Student creates an account to post polls and quiz's and to partake in polls and quiz's

Pre-condition: Must be on server

Post-condition: Allows user to sign in and user is stored into database

Main scenario:

1. System asks if User is a student or instructor
2. User makes a Username.
3. User makes a password.
4. Database saves Users information

Extensions:
1.1 Username is already taken.<br>
  1.1.1 system prompts username is taken

#### Use Case 2. Sign In

Primary actor: Student, Instructor

Description: User logs into account

Pre-condition: User must have an account

Post-condition: Student and Instructor has access to their specific account

Main scenario:

1. User enters username
2. User enters password
3. User has access to their account

Extensions:

1.1 If Username is not recognized.<br>
  1.1.1 System displays wrong username
2.1 If password is not recognized.<br>
  2.1.1 System displays wrong password
3.1 User does not have a account. <br>
  3.1.1 User needs to create account

#### Use Case 3. Create a Class
Primary actor: Instructor

Description: Instructor adds their class so the site 

Pre-condition: User is signed in as an instructor

Post-condition: Instructor has added their class to the site and their students are able to find and join

Main scenario:
1. User navigates to the add class page
2. User enters the name of their institution 
3. They enter the name of their class and section
4. Class is added to database and saved in their account

#### Use Case 4. Enroll in/Join a Class
Primary actor: Student

Description: Student enrolls in a class 

Pre-condition: User is signed in as a student and the class they're enrolling in already exists on the system

Post-condition: Student is enrolled in class and can participate in class questions/polls

Main scenario:
1. Student uses search tool to find their class
2. Student joins course
3. Course is added to student's course list

#### Use case 5. Create a Poll/Quiz

Primary Actor: Instructor

Descirption: The instructor wants to create a quiz/poll to assess their students' knowledge of a specific subject or concept. this use case combines creating a quiz or poll, where a quiz is a series of polls (questions).

Pre-conditions: The instructor has an account and is signed in to their account.

Post-conditions: The instructor has successfully created a quiz/poll and is able to save the quiz to thier account and also luanch the quiz if desired.

Main Scenario:

1. The instructor selects the option to create a new quiz/poll.
2. The instructor selects add poll.
3. The instructor can upload a photo or capture an image of their screen to provide a visual aid or context for the question.
4. repeat steps 2 and 3 for adding more questions if creating a quiz.
5. The instructor saves the quiz/poll for later use and or modifying (Use case 6.).
6. The instructor clicks launch and is asked to review before launching where students enrolled in the class are able to answer it.

Extensions:

3.1 The instructor needs to capture their screen but has not provided these privileges.<br>
  3.1.1 The instructor allows the required privileges and is able to share and capture parts of their screen.
  
4.1 The instructor accidentally adds a new poll.<br>
  4.1.1 The instructor is able to cancel the new poll and resume as intended.
  
#### Use Case 6. Modifying a quiz or poll

Primary Actor: Instructor

Descirption: The instructor wants to modifiy an existing quiz or poll.

Pre-conditions: The instructor has an account, is signed in to their account and has already created a quiz or poll .

Post-conditions: The instructor has successfully modified the desired quiz/poll and is able to save changes and launch it is desired.

Main Scenario:

1. The instructor selects the quiz/poll they want to modify.
2. The instructor selects modify/edit.
3. The instructor makes appropriate changes (this extends use case 5. step 3.)
4. The instructor saves the quiz/poll for later use and or modifying again.

#### Use Case 7. Start previously created and saved Quiz/Poll

#### Use Case 8. Answer Quiz/poll
