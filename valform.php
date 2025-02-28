<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opinion Value Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        label, select, input { display: block; margin-top: 10px; }
        button { margin-top: 20px; padding: 10px; }
    </style>
</head>
<body>
    <label>Age:</label>
    <input type="number" id="age" min="0" value="18">
    
    <label>Education Level:</label>
    <select id="education">
        <option value="0.25">Uneducated/Drop before 10</option>
        <option value="0.5">10 Pass</option>
        <option value="0.6">12 Pass</option>
        <option value="0.75">Graduate</option>
        <option value="1">PhD / MD / Post Graduate</option>
    </select>
    
    <label>Self Income (Annual):</label>
    <input type="number" id="selfIncome" min="0" value="100">
    
    <label>Family Income (Annual):</label>
    <input type="number" id="familyIncome" min="0" value="100">
    
    <label>Years of Stock Market Experience:</label>
    <input type="number" id="experience" min="0" value="0">
    
    <button onclick="calculateValue()">Lets Go</button>
    <script>
        let points = 0.0;
        function calculateValue() {
            
            let age = parseInt(document.getElementById("age").value);
            points += 0.1 * age
            
            points += parseFloat(document.getElementById("education").value) * 0.25;
            
            let selfInc = parseFloat(document.getElementById("selfIncome").value);
            let famInc = parseFloat(document.getElementById("familyIncome").value);
            let experience = parseInt(document.getElementById("experience").value);
                        
            points += 0.1 + 1 * experience;
            points += selfInc / famInc * 0.5;

            document.getElementById("game").style.visibility = "visible";
            document.getElementById("playereval").style.visibility = "hidden";
            document.getElementById("playereval").style.height = '0';

            console.log(points);
        }
    </script>
</body>
</html>
