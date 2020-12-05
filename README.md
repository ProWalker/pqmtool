# Tool for convert questions for LMS Moodle from text to xml format.

## Install:
    composer require pqmtool/pqmtool
## How to use:
First of all, you need text file with questions in special format.<br/>
At this moment this tool supports the following questions:<br/>
* Multichoice question
* Shortanswer question

**Multichoice question format:**<br/>
1. question text
2. answer variant n
3. Answer: 1

**Note:** answer for this question supports only numbers.<br/>

**Shortanswer question format:**<br/>
1. question text
2. Answer: your answer

**Note:** You can list the answers separated by commas.

### Code example for app.php file:
    $file = $argv[1];
    $fileToArray = parseFileToArray($file);
    $tool = new PQMTool();
    $questions = $tool->parseQuestions($fileToArray);

**In cli:**<br/>

    php app.php example.txt