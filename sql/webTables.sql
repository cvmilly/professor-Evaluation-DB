CREATE TABLE College (
college_id INTEGER,
college_name VARCHAR(60) NOT NULL,
PRIMARY KEY (college_id)
);


CREATE TABLE Department (
college_id INTEGER,
dept_id INTEGER,
dept_name VARCHAR(60) NOT NULL,
PRIMARY KEY (college_id, dept_id),
FOREIGN KEY (college_id) REFERENCES College (college_id)
);


CREATE TABLE Professor (
prof_id INTEGER,
prof_name VARCHAR(60) NOT NULL,
credentials VARCHAR(30),
college_id INTEGER,
dept_id INTEGER,
PRIMARY KEY (prof_id),
FOREIGN KEY (college_id, dept_id) REFERENCES Department (college_id, dept_id)
);


CREATE TABLE Prof_Rev (
prev_num INTEGER,
prof_id INTEGER,
availability INTEGER,
oral_rev INTEGER,
visual_rev INTEGER,
helpfulness INTEGER,
recommend BOOLEAN,
term CHARACTER NOT NULL,
year INTEGER NOT NULL,
PRIMARY KEY (prev_num, prof_id),
FOREIGN KEY (prof_id) REFERENCES Professor (prof_id)
);


CREATE TABLE Course (
course_id VARCHAR(8),
course_name VARCHAR(60) NOT NULL,
credits INTEGER NOT NULL,
dist_learning BOOLEAN,
college_id INTEGER,
dept_id INTEGER,
PRIMARY KEY (course_id),
FOREIGN KEY (college_id, dept_id) REFERENCES Department (college_id, dept_id)
);


CREATE TABLE Course_Rev (
crev_num INTEGER,
course_id VARCHAR(8),
difficulty INTEGER,
assignment_based INTEGER,
test_based INTEGER,
workload INTEGER,
course_reception INTEGER,
required BOOLEAN,
PRIMARY KEY (crev_num, course_id),
FOREIGN KEY (course_id) REFERENCES Course (course_id)
);
