create schema gpa_system;

CREATE TABLE teachers                
(                
id bigint(20) AUTO_INCREMENT PRIMARY KEY,
created_at timestamp NULL DEFAULT NULL,
updated_at timestamp NULL DEFAULT NULL,
teacher_code VARCHAR(10) ,   
teacher_name VARCHAR(255),
teacher_gender varchar(20),
teacher_phone varchar(12),
UNIQUE KEY teachers_code_unique (teacher_code)
); 

INSERT INTO teachers
VALUES 
(NULL,current_timestamp(),current_timestamp(),'T001','Kittipoom Wongfu','Male','0861234855'),
(NULL,current_timestamp(),current_timestamp(),'T002','Juliet Warner','Male','0911412659'),
(NULL,current_timestamp(),current_timestamp(),'T003','Naya Carney','Female','0844712566'),
(NULL,current_timestamp(),current_timestamp(),'T004','Jaylan Pace','Male','0947854158'),
(NULL,current_timestamp(),current_timestamp(),'T005','Paris Slater','Female','0978542351');

CREATE TABLE courses (
    id bigint(20) AUTO_INCREMENT,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    course_code varchar(10),
    course_name varchar(255),
    credit int,
    descriptions text,
    PRIMARY KEY (id),
        UNIQUE KEY course_code_unique (course_code)
);


INSERT INTO courses
VALUES 
(NULL,current_timestamp(),current_timestamp(),'C001','Statistics',3,'Statistics is the study and manipulation of data, including ways to gather, review, analyze, and draw conclusions from data. The two major areas of statistics are descriptive and inferential statistics. Statistics can be used to make better-informed business and investing decisions.'),
(NULL,current_timestamp(),current_timestamp(),'C002','ERP',3,'Enterprise resource planning (ERP) is defined as the ability to deliver an integrated suite of business applications. ERP tools share a common process and data model, covering broad and deep operational end-to-end processes, such as those found in finance, HR, distribution, manufacturing, service and the supply chain.'),
(NULL,current_timestamp(),current_timestamp(),'C003','Visual art',2,'Students explore media and techniques used to create a variety of 2-D artworks in drawing, painting, printmaking, and collage. Students practice, sketch, and manipulate the structural elements of art. ... This course incorporates hands-on activities and consumption of art materials.'),
(NULL,current_timestamp(),current_timestamp(),'C004','Introduction to Microsoft Excel',1,'In this Introduction to Microsoft Excel 2016 training course, students will create and edit basic worksheets and workbooks. This course is designed for students who want to gain the necessary skills to create, edit, format, and print basic Microsoft Excel 2016 worksheets.');

CREATE TABLE students                
(                
id bigint(20) AUTO_INCREMENT PRIMARY KEY,
created_at timestamp NULL DEFAULT NULL,
updated_at timestamp NULL DEFAULT NULL,
student_code VARCHAR(10) ,   
student_name VARCHAR(255) ,  
student_year varchar(20),
student_gender varchar(20),
student_phone varchar(12),
UNIQUE KEY students_code_unique (student_code)
);

INSERT INTO students
VALUES 
(NULL,current_timestamp(),current_timestamp(),'S001','Tanut Jaidee','1','Male','0841474751'),
(NULL,current_timestamp(),current_timestamp(),'S002','Apigorn pornrattanapitak','1','Male','0985655896'),
(NULL,current_timestamp(),current_timestamp(),'S003','Ehsan Saunders','2','Female','0965482153'),
(NULL,current_timestamp(),current_timestamp(),'S004','Izaan Morgan','2','Male','0869851397'),
(NULL,current_timestamp(),current_timestamp(),'S005','Saba Kline','4','Male','0861332574'),
(NULL,current_timestamp(),current_timestamp(),'S006','Lily Odonnell','4','Female','0941247477'),
(NULL,current_timestamp(),current_timestamp(),'S007','Fynn Wickens','3','Female','0860120144'),
(NULL,current_timestamp(),current_timestamp(),'S008','Aariz Pemberton','1','Male','0869741301');

CREATE TABLE course_student (
    student_id bigint(20),
    course_id bigint(20),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (student_id,course_id),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

INSERT INTO course_student
VALUES 
(1,1,current_timestamp(),current_timestamp()),
(1,2,current_timestamp(),current_timestamp()),
(1,3,current_timestamp(),current_timestamp()),
(1,4,current_timestamp(),current_timestamp()),
(2,1,current_timestamp(),current_timestamp()),
(2,2,current_timestamp(),current_timestamp()),
(2,3,current_timestamp(),current_timestamp()),
(2,4,current_timestamp(),current_timestamp()),
(3,2,current_timestamp(),current_timestamp()),
(3,3,current_timestamp(),current_timestamp()),
(3,4,current_timestamp(),current_timestamp()),
(4,1,current_timestamp(),current_timestamp()),
(4,2,current_timestamp(),current_timestamp()),
(4,4,current_timestamp(),current_timestamp()),
(5,1,current_timestamp(),current_timestamp()),
(5,2,current_timestamp(),current_timestamp()),
(6,1,current_timestamp(),current_timestamp()),
(7,3,current_timestamp(),current_timestamp()),
(7,4,current_timestamp(),current_timestamp()),
(8,2,current_timestamp(),current_timestamp());

CREATE TABLE course_teacher (
    course_id bigint(20),
    teacher_id bigint(20),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (course_id,teacher_id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);

INSERT INTO course_teacher
VALUES 
(1,1,current_timestamp(),current_timestamp()),
(1,4,current_timestamp(),current_timestamp()),
(2,1,current_timestamp(),current_timestamp()),
(2,2,current_timestamp(),current_timestamp()),
(2,3,current_timestamp(),current_timestamp()),
(3,3,current_timestamp(),current_timestamp()),
(4,4,current_timestamp(),current_timestamp()),
(4,1,current_timestamp(),current_timestamp());

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (
  `name`, `email`, `email_verified_at`,
  `password`,
  `role`, `created_at`, `updated_at`
)
VALUES 
(
  'Administrator', 'admin@gpa.com', CURRENT_TIMESTAMP(),
  '$2y$10$RGuRSLsfJUdaELnY9ZUER.w4pqSyoHeiluriZRahtJB1nWBNYUuwW',
  'ADMIN', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP() 
),
(
  'Guest', 'guest@gpa.com', CURRENT_TIMESTAMP(),
  '$2y$10$ggNGqa1vmznIwhTFcSRkoeBEI5ZN/EDYTwQAfBeIHYogpxGCNzfJG',
  'USER', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP() 
)