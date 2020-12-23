# Buto-Plugin-ValidateInteger
Form validator for plugin form/form_v1.

## Settings
```
items:
  persons:
    type: varchar
    label: Persons
    validator:
      -
        plugin: validate/integer
        method: validate_integer    
        data:
          min: 2
          max: 33
```
