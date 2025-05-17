<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .score-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .overall-score {
            text-align: center;
            font-size: 24px;
            margin: 30px 0;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .maturity-level {
            font-weight: bold;
            color: #0056b3;
        }
        .recommendations {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
        }
        .recommendations ul {
            margin: 0;
            padding-left: 20px;
        }
        .recommendations li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Digital Maturity Assessment Results</h1>
            <p>Thank you for completing the Digital Maturity Assessment. Here are your results:</p>
        </div>

        <div class="overall-score">
            <h2>Overall Score: {{ $totalScore['percentage'] }}%</h2>
            <p>Your Digital Maturity Level: <span class="maturity-level">{{ $totalScore['level'] }}</span></p>
        </div>

        <h3>Section Scores and Recommendations:</h3>
        @foreach($categoryScores as $section => $score)
            <div class="score-section">
                <h4>{{ $section }}</h4>
                <p>Score: {{ $score['percentage'] }}%</p>
                <p>Points: {{ $score['score'] }}/{{ $score['max'] }}</p>
                <p>Maturity Level: <span class="maturity-level">{{ $score['level'] }}</span></p>
                
                @if($section !== 'Validation Section')
                    <div class="recommendations">
                        <h5>Recommendations:</h5>
                        <ul>
                            @foreach($score['recommendations'] as $recommendation)
                                <li>{{ $recommendation }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach

        <p style="margin-top: 30px;">
            Thank you for participating in our Digital Maturity Assessment. If you have any questions about your results, 
            please don't hesitate to contact us.
        </p>
    </div>
</body>
</html> 