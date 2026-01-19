DELETE FROM documents WHERE subject_id = 1;

INSERT INTO documents (title, description, file_path, file_type, subject_id, uploaded_by) VALUES 
(
    'Slide Chương 1: Giới thiệu', 
    'Tổng quan về lập trình và máy tính.', 
    'frontend/uploads/IT001/Slide_Chuong_1.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 2: Các thành phần cơ bản', 
    'Biến, Kiểu dữ liệu, Hằng số trong C/C++.', 
    'frontend/uploads/IT001/Slide_Chuong_2.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 3.1: Cấu trúc rẽ nhánh (Phần 1)', 
    'Câu lệnh if-else và switch-case.', 
    'frontend/uploads/IT001/Slide_Chuong_3.1.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 3.2: Cấu trúc rẽ nhánh (Phần 2)', 
    'Bài tập nâng cao về rẽ nhánh.', 
    'frontend/uploads/IT001/Slide_Chuong_3.2.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 4.1: Cấu trúc lặp (Phần 1)', 
    'Vòng lặp for, while, do-while.', 
    'frontend/uploads/IT001/Slide_Chuong_4.1.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 4.2: Cấu trúc lặp (Phần 2)', 
    'Vòng lặp lồng nhau và bài tập.', 
    'frontend/uploads/IT001/Slide_Chuong_4.2.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 5: Hàm (Function)', 
    'Cách viết và sử dụng hàm trong C++.', 
    'frontend/uploads/IT001/Slide_Chuong_5.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 6: Mảng một chiều', 
    'Khai báo và thao tác trên mảng số nguyên.', 
    'frontend/uploads/IT001/Slide_Chuong_6.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 7.1: Chuỗi ký tự (String) - P1', 
    'Làm việc với mảng ký tự (char array).', 
    'frontend/uploads/IT001/Slide_Chuong_7.1.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 7.2: Chuỗi ký tự (String) - P2', 
    'Các hàm xử lý chuỗi trong thư viện string.', 
    'frontend/uploads/IT001/Slide_Chuong_7.2.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 7.3: Chuỗi ký tự (String) - P3', 
    'Bài tập vận dụng xử lý chuỗi.', 
    'frontend/uploads/IT001/Slide_Chuong_7.3.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 8.1: Mảng hai chiều (Phần 1)', 
    'Ma trận và cách duyệt mảng 2 chiều.', 
    'frontend/uploads/IT001/Slide_Chuong_8.1.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 8.2: Mảng hai chiều (Phần 2)', 
    'Bài tập thao tác trên ma trận.', 
    'frontend/uploads/IT001/Slide_Chuong_8.2.pdf', 
    'pdf', 1, 1
),
(
    'Slide Chương 9: Struct & Kiểu dữ liệu có cấu trúc', 
    'Định nghĩa struct và mảng struct.', 
    'frontend/uploads/IT001/Slide_Chuong_9.pdf', 
    'pdf', 1, 1
);