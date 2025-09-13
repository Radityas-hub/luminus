<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Enrollment Report</h2>
    <table>
        <thead>
            <tr>
                <th>Enrollment Date</th>
                <th>Course</th>
                <th>Student</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $enrollment)
                <tr>
                    <td>{{ $enrollment->created_at->format('Y-m-d') }}</td>
                    <td>{{ $enrollment->course->title }}</td>
                    <td>{{ $enrollment->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>