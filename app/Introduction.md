## Daftar Bugs yang Harus Diperbaiki (35 Bugs)

1. **Routes.php**: Missing auth filter pada refresh endpoint
2. **Routes.php**: Inconsistent API prefix
3. **Routes.php**: Wrong filter name untuk tasks
4. **Database.php**: Database might not exist
5. **Database.php**: Missing test database config
6. **AuthController**: No input validation pada register
7. **AuthController**: Password tidak di-hash
8. **AuthController**: Mengembalikan password dalam response
9. **AuthController**: No input validation pada login
10. **AuthController**: Plain text password comparison
11. **AuthController**: Missing refresh implementation
12. **UserController**: No pagination
13. **UserController**: No ID validation
14. **UserController**: Returning sensitive data
15. **UserController**: No authorization check pada update
16. **UserController**: No input validation pada update
17. **UserController**: No authorization check pada delete
18. **ProjectController**: Shows all projects instead of user's only
19. **ProjectController**: No input validation pada create
20. **ProjectController**: Not setting user_id from JWT
21. **ProjectController**: No ownership check pada show
22. **ProjectController**: No ownership check pada update
23. **ProjectController**: No ownership check pada delete
24. **TaskController**: No filtering by project/user
25. **TaskController**: No validation for required fields
26. **TaskController**: Not validating project ownership
27. **TaskController**: No access control pada show
28. **TaskController**: No validation for status updates
29. **UserModel**: No validation rules
30. **UserModel**: No timestamp handling
31. **UserModel**: Weak password hashing (MD5)
32. **ProjectModel**: No validation rules
33. **TaskModel**: No validation rules
34. **JWTAuthFilter**: Wrong token format handling
35. **JWTAuthFilter**: Not setting user data in request
36. **JWTLibrary**: Hardcoded secret key
37. **JWTLibrary**: No proper token validation
38. **JWTLibrary**: No signature verification
39. **Database**: Missing foreign key constraint pada projects
40. **Database**: Missing foreign key constraint pada tasks

## Instruksi Setup

1. Install CodeIgniter 4
2. Copy semua file ke folder yang sesuai
3. Buat database 'task_management'
4. Jalankan migration SQL
5. Configure database di app/Config/Database.php
6. Test API menggunakan Postman
