# php_task_2

1. Clone repo to your own github
2. Read the configuration.json
3. Use https://flightphp.com/
4. Use this library to connect to mysql https://redbeanphp.com/index.php
5. Create release folder
6. Make a class called Model_builder.php with function build.
7. In build function, read the configuration.json and make the following for each model:

- add form view page that submit it to an api that save to database for current model

7. This need to be done today

Example

```
configuration.json
field columns are (the field name, the field type, the field label, the validation rule)
{
"model": [
  {
  "name": "location",
  "field: [
    ["id", "integer", "ID", "required"],
    ["name", "string", "Name", "required"],
    ["status", "integer", "Status", "required"],
  ]
  },
  {
  "name": "user",
  "field: [
    ["id", "integer", "ID", "required"],
    ["name", "string", "Name", "required"],
    ["email", "string", "Email", "required"],
    ["status", "integer", "Status", "required"],
  ]
  }
]
}
add view page (you need to generate this from configuration.json. If there are more fields, should generate it)
<form method="POST" action="/api/location">
<label>Name</label>
<input type="text" name="name" id="name" value="" required/>
<label>Status</label>
<input type="number" name="status" id="status" value="" required/>
<input type="submit" name="submit" id="submit" value="Submit"/>
</form>
```
