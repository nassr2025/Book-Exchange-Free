
-- Script Generated: 2025-07-13 01:39:27

-- 1. تعديل جدول الطلاب لإضافة college_id و major_id
ALTER TABLE students 
ADD COLUMN college_id INT AFTER password,
ADD COLUMN major_id INT AFTER college_id;

-- 2. إنشاء جدول الكليات إذا لم يكن موجودًا
CREATE TABLE IF NOT EXISTS colleges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- 3. إنشاء جدول التخصصات إذا لم يكن موجودًا
CREATE TABLE IF NOT EXISTS majors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    college_id INT,
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (college_id) REFERENCES colleges(id) ON DELETE CASCADE
);

-- 4. ربط مفاتيح خارجية (اختياري - إذا لم تكن موجودة)
ALTER TABLE students
ADD FOREIGN KEY (college_id) REFERENCES colleges(id) ON DELETE SET NULL,
ADD FOREIGN KEY (major_id) REFERENCES majors(id) ON DELETE SET NULL;
