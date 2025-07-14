DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `books`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `admin`;

-- CREATE TABLES

-- Table: students
CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    college VARCHAR(100),
    major VARCHAR(100),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: books
CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(150),
    description TEXT,
    college VARCHAR(100),
    student_id INT,
    type ENUM('Sale', 'Exchange') DEFAULT 'Exchange',
    price DECIMAL(10,2),
    image VARCHAR(255),
    file_pdf VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- Table: messages
CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT,
    receiver_id INT,
    book_id INT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Table: admin
CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);


-- INSERT DATA
-- Students
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (1, 'لورا شربتلي', 'student1@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية العلوم والدراسات الإنسانية', 'التمريض', '(022)798-6040', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (2, 'شادن آل عواض', 'student2@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الهندسة', 'دكتور صيدلي', '478-287-9394', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (3, 'الدكتور عتيد آل مقطة', 'student3@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الآداب', 'إصلاح الأسنان', '617-297-9884', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (4, 'السيد صبري آل حسين', 'student4@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'الكليات التطبيقية', 'تربية خاصة', '635-528-1444x516', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (5, 'كوثر فصيل', 'student5@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الآداب', 'هندسة كهربائية', '(134)137-5506x027', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (6, 'السيدة روفيدا شربتلي', 'student6@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الهندسة', 'هندسة كهربائية', '+1-943-975-4630x321', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (7, 'ميّاد حجار', 'student7@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية طب الأسنان', 'فيزياء', '074-869-2886x4891', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (8, 'الأستاذة بهابهاء فصيل', 'student8@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية إدارة الأعمال', 'إصلاح الأسنان', '506-311-1672x07655', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (9, 'المهندس علوان آل العسكري', 'student9@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الطب البشري', 'إصلاح الأسنان', '001-858-115-1562x08610', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (10, 'بتلاء آل عايض', 'student10@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية العلوم والدراسات الإنسانية', 'تربية خاصة', '(767)258-9855x057', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (11, 'الأستاذ سعدي فصيل', 'student11@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية هندسة وعلوم الحاسب', 'طب وجراحة', '049-252-8775', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (12, 'ناهد آل عطفة', 'student12@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية العلوم الطبية التطبيقية', 'هندسة الحاسب', '(654)217-1331', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (13, 'الدكتور عبد الرّشيد آل مقطة', 'student13@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية التربية', 'فيزياء', '+1-292-187-7894x72869', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (14, 'الدكتورة باسمة آل عطفة', 'student14@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الصيدلة', 'طب وجراحة', '001-518-002-6576x2466', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (15, 'الأستاذة ريف أبو داوود', 'student15@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الآداب', 'دكتور صيدلي', '001-757-124-3842', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (16, 'مادلين حجار', 'student16@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية طب الأسنان', 'طب وجراحة', '+1-275-676-2602x62642', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (17, 'غزوان آل جعفر', 'student17@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية التربية', 'التمريض', '927.347.9919x87879', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (18, 'الأستاذ رزين أبو داوود', 'student18@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية التربية', 'هندسة الحاسب', '+1-909-820-7442', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (19, 'جوانا آل صفوان', 'student19@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية هندسة وعلوم الحاسب', 'برمجة', '6583946909', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (20, 'المهندس علّام فصيل', 'student20@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية هندسة وعلوم الحاسب', 'التمريض', '001-783-917-7401x276', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (21, 'هيام المشاولة', 'student21@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الآداب', 'التمريض', '044-500-8159x1325', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (22, 'شكري العقيل', 'student22@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية التربية', 'تربية خاصة', '001-025-372-6530x14408', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (23, 'المهندس محسن آل صفوان', 'student23@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية العلوم الطبية التطبيقية', 'برمجة', '+1-685-013-8687x3611', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (24, 'الدكتورة جلنار آل جعفر', 'student24@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية طب الأسنان', 'تربية خاصة', '(297)769-7990x820', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (25, 'الأستاذة هيام آل محمد بن علي بن جماز', 'student25@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية إدارة الأعمال', 'فيزياء', '050.167.7263x460', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (26, 'السيدة راما آل الشيخ', 'student26@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الصيدلة', 'هندسة كهربائية', '001-263-028-4423x558', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (27, 'الآنسة ليان مهنا', 'student27@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية إدارة الأعمال', 'إدارة الأعمال', '001-767-691-8770', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (28, 'السيد مرسال فصيل', 'student28@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية التربية', 'إدارة الأعمال', '869-980-8857', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (29, 'طيّع حجار', 'student29@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'الكليات التطبيقية', 'طب وجراحة', '844.061.4624', NOW());
INSERT INTO students (id, name, email, password, college, major, phone, created_at) VALUES (30, 'الأستاذ زهير شربتلي', 'student30@psau.edu.sa', '$2y$10$abcdefghijk1234567890', 'كلية الصيدلة', 'لغة عربية', '899.031.0640x534', NOW());

-- Books
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (1, 'قانون تجاري', 'كتاب قانون تجاري مخصص لطلبة فيزياء', 'كلية هندسة وعلوم الحاسب', 1, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (2, 'هياكل البيانات', 'كتاب هياكل البيانات مخصص لطلبة برمجة', 'كلية الطب البشري', 1, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (3, 'قانون تجاري', 'كتاب قانون تجاري مخصص لطلبة لغة عربية', 'كلية العلوم الطبية التطبيقية', 2, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (4, 'قانون تجاري', 'كتاب قانون تجاري مخصص لطلبة إصلاح الأسنان', 'كلية الهندسة', 3, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (5, 'أصول اللغة', 'كتاب أصول اللغة مخصص لطلبة برمجة', 'كلية الصيدلة', 4, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (6, 'الأشعة التشخيصية', 'كتاب الأشعة التشخيصية مخصص لطلبة طب وجراحة', 'كلية طب الأسنان', 5, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (7, 'تمريض أساسي', 'كتاب تمريض أساسي مخصص لطلبة إدارة الأعمال', 'الكليات التطبيقية', 5, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (8, 'الفيزياء الكهرومغناطيسية', 'كتاب الفيزياء الكهرومغناطيسية مخصص لطلبة إدارة الأعمال', 'كلية العلوم الطبية التطبيقية', 6, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (9, 'إدارة الأعمال', 'كتاب إدارة الأعمال مخصص لطلبة تربية خاصة', 'كلية طب الأسنان', 6, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (10, 'نحو متقدم', 'كتاب نحو متقدم مخصص لطلبة دكتور صيدلي', 'كلية الطب البشري', 7, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (11, 'مقدمة في الإحصاء', 'كتاب مقدمة في الإحصاء مخصص لطلبة تربية خاصة', 'كلية التربية', 8, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (12, 'ميكانيك التربة', 'كتاب ميكانيك التربة مخصص لطلبة طب وجراحة', 'الكليات التطبيقية', 9, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (13, 'المحاسبة المالية', 'كتاب المحاسبة المالية مخصص لطلبة فيزياء', 'كلية طب الأسنان', 10, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (14, 'إدارة الأعمال', 'كتاب إدارة الأعمال مخصص لطلبة التمريض', 'كلية الآداب', 11, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (15, 'الجبر الخطي', 'كتاب الجبر الخطي مخصص لطلبة طب وجراحة', 'كلية هندسة وعلوم الحاسب', 11, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (16, 'الشبكات الحاسوبية', 'كتاب الشبكات الحاسوبية مخصص لطلبة لغة عربية', 'كلية التربية', 12, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (17, 'نظم المعلومات الإدارية', 'كتاب نظم المعلومات الإدارية مخصص لطلبة دكتور صيدلي', 'كلية التربية', 12, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (18, 'نظم المعلومات الإدارية', 'كتاب نظم المعلومات الإدارية مخصص لطلبة التمريض', 'كلية طب الأسنان', 13, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (19, 'تمريض أساسي', 'كتاب تمريض أساسي مخصص لطلبة إصلاح الأسنان', 'كلية العلوم والدراسات الإنسانية', 14, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (20, 'ميكانيكا المواد', 'كتاب ميكانيكا المواد مخصص لطلبة دكتور صيدلي', 'كلية التربية', 14, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (21, 'الفيزياء الكهرومغناطيسية', 'كتاب الفيزياء الكهرومغناطيسية مخصص لطلبة دكتور صيدلي', 'كلية الصيدلة', 15, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (22, 'مبادئ التسويق', 'كتاب مبادئ التسويق مخصص لطلبة هندسة الحاسب', 'كلية العلوم الطبية التطبيقية', 16, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (23, 'قانون تجاري', 'كتاب قانون تجاري مخصص لطلبة إدارة الأعمال', 'كلية الهندسة', 17, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (24, 'علم الأحياء الدقيقة', 'كتاب علم الأحياء الدقيقة مخصص لطلبة فيزياء', 'كلية طب الأسنان', 17, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (25, 'علم الأحياء الدقيقة', 'كتاب علم الأحياء الدقيقة مخصص لطلبة التمريض', 'كلية الهندسة', 18, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (26, 'دوائر كهربائية', 'كتاب دوائر كهربائية مخصص لطلبة إصلاح الأسنان', 'كلية التربية', 18, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (27, 'البلاغة العربية', 'كتاب البلاغة العربية مخصص لطلبة هندسة كهربائية', 'الكليات التطبيقية', 19, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (28, 'برمجة بلغة C++', 'كتاب برمجة بلغة C++ مخصص لطلبة فيزياء', 'كلية طب الأسنان', 19, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (29, 'مقدمة في الإحصاء', 'كتاب مقدمة في الإحصاء مخصص لطلبة لغة عربية', 'كلية هندسة وعلوم الحاسب', 20, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (30, 'برمجة بلغة C++', 'كتاب برمجة بلغة C++ مخصص لطلبة تربية خاصة', 'كلية إدارة الأعمال', 21, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (31, 'قانون تجاري', 'كتاب قانون تجاري مخصص لطلبة فيزياء', 'كلية هندسة وعلوم الحاسب', 21, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (32, 'مقدمة في الإحصاء', 'كتاب مقدمة في الإحصاء مخصص لطلبة لغة عربية', 'كلية الصيدلة', 22, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (33, 'الجبر الخطي', 'كتاب الجبر الخطي مخصص لطلبة طب وجراحة', 'كلية إدارة الأعمال', 23, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (34, 'الأشعة التشخيصية', 'كتاب الأشعة التشخيصية مخصص لطلبة إدارة الأعمال', 'كلية العلوم والدراسات الإنسانية', 23, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (35, 'مبادئ التسويق', 'كتاب مبادئ التسويق مخصص لطلبة إدارة الأعمال', 'كلية الهندسة', 24, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (36, 'الشبكات الحاسوبية', 'كتاب الشبكات الحاسوبية مخصص لطلبة دكتور صيدلي', 'كلية الطب البشري', 25, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (37, 'مقدمة في الإحصاء', 'كتاب مقدمة في الإحصاء مخصص لطلبة دكتور صيدلي', 'كلية العلوم والدراسات الإنسانية', 25, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (38, 'علم الأدوية', 'كتاب علم الأدوية مخصص لطلبة هندسة كهربائية', 'كلية الهندسة', 26, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (39, 'أنظمة التشغيل', 'كتاب أنظمة التشغيل مخصص لطلبة التمريض', 'كلية الطب البشري', 26, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (40, 'المحاسبة المالية', 'كتاب المحاسبة المالية مخصص لطلبة إدارة الأعمال', 'كلية إدارة الأعمال', 27, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (41, 'الكيمياء العضوية', 'كتاب الكيمياء العضوية مخصص لطلبة طب وجراحة', 'كلية العلوم الطبية التطبيقية', 27, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (42, 'هياكل البيانات', 'كتاب هياكل البيانات مخصص لطلبة لغة عربية', 'كلية العلوم الطبية التطبيقية', 28, 'Exchange', 35.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (43, 'مقدمة في الإحصاء', 'كتاب مقدمة في الإحصاء مخصص لطلبة تربية خاصة', 'كلية الآداب', 29, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (44, 'الفيزياء الكهرومغناطيسية', 'كتاب الفيزياء الكهرومغناطيسية مخصص لطلبة فيزياء', 'كلية العلوم والدراسات الإنسانية', 29, 'Exchange', 50.0, 'default.jpg', 'sample.pdf', NOW());
INSERT INTO books (id, title, description, college, student_id, type, price, image, file_pdf, created_at) VALUES (45, 'برمجة بلغة C++', 'كتاب برمجة بلغة C++ مخصص لطلبة هندسة كهربائية', 'كلية العلوم الطبية التطبيقية', 30, 'Exchange', 0.0, 'default.jpg', 'sample.pdf', NOW());

-- Messages
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (15, 23, 32, 'Ratione inventore et nulla nam velit ut qui eos ab.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (14, 12, 29, 'Ducimus numquam temporibus impedit molestiae.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (25, 26, 25, 'Vero totam qui reiciendis quas quaerat.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (15, 18, 16, 'Quasi quasi aliquid ipsum eveniet nisi.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (30, 27, 12, 'Odio earum distinctio quas illo reprehenderit dignissimos.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (14, 9, 12, 'A odit qui est rerum accusamus.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (22, 7, 35, 'Magni dolores quaerat reprehenderit enim.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (9, 8, 12, 'Quo eum excepturi dignissimos suscipit.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (5, 12, 9, 'Similique expedita natus nemo cum itaque eligendi.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (13, 6, 34, 'Exercitationem quidem illum nostrum accusamus.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (30, 5, 5, 'Accusamus praesentium explicabo veniam earum saepe maxime quaerat.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (29, 26, 40, 'Repellat iusto dolor dicta ad.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (22, 25, 2, 'Porro quae ratione ipsam vel dolor officiis ex.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (2, 19, 2, 'Ea provident repellat consectetur at molestiae consequuntur iste tempora perspiciatis necessitatibus.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (12, 3, 39, 'Eos assumenda dolorum totam praesentium tempore velit ab earum excepturi.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (25, 26, 26, 'Doloribus quas architecto quae accusantium fugit ipsa magnam.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (17, 23, 21, 'Esse minima voluptatibus sapiente error explicabo sit sunt odio.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (19, 15, 10, 'Architecto et nesciunt laboriosam officiis blanditiis placeat odit libero voluptatum.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (22, 11, 26, 'Accusantium eos dolorum soluta sunt facilis.', NOW());
INSERT INTO messages (sender_id, receiver_id, book_id, message, created_at) VALUES (12, 24, 6, 'Est eveniet architecto iure adipisci libero quas.', NOW());

-- Admin
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$abcdefghijk1234567890');
