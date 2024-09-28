<!DOCTYPE html>
<html>
<head>
    <title>Task Reminder</title>
</head>
<body>
    <h1>Task Reminder</h1>
    <p>Dear {{ $task->user->name }},</p>
    <p>This is a reminder for your task: <strong>{{ $task->title }}</strong></p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
    <p>Best regards,<br>{{ config('app.name') }} Team</p>
</body>
</html>
