<!DOCTYPE html>
<html>
<head>
<title>Online Exam</title>
</head>
<body>

<h2>Online Exam</h2>

<form id="examForm">
    1. What is the capital of India?<br>
    <input type="radio" name="q1" value="Delhi">Delhi<br>
    <input type="radio" name="q1" value="Mumbai">Mumbai<br><br>

    2. 2 + 2 = ?<br>
    <input type="radio" name="q2" value="4">4<br>
    <input type="radio" name="q2" value="5">5<br><br>

    <button type="button" onclick="checkResult()">Submit</button>
</form>

<h3 id="result"></h3>

<script>
function checkResult() {
    let score = 0;

    if (document.querySelector('input[name="q1"]:checked')?.value == "Delhi")
        score++;

    if (document.querySelector('input[name="q2"]:checked')?.value == "4")
        score++;

    document.getElementById("result").innerHTML = "Your Score: " + score;
}
</script>

</body>
</html>

