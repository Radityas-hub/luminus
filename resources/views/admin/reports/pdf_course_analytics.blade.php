<!DOCTYPE html>
<html>
<head>
    <title>Course Analytics</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Course Analytics</h2>
    <table>
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Instructor</th>
                <th>Total Enrollments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->instructor->name }}</td>
                    <td>{{ $course->enrollments_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>