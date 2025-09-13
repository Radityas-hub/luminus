<!DOCTYPE html>
<html>
<head>
    <title>Instructor Performance</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Instructor Performance</h2>
    <table>
        <thead>
            <tr>
                <th>Instructor</th>
                <th>Total Courses</th>
                <th>Total Enrollments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $instructor)
                <tr>
                    <td>{{ $instructor->name }}</td>
                    <td>{{ $instructor->courses->count() }}</td>
                    <td>{{ $instructor->courses->sum('enrollments_count') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>