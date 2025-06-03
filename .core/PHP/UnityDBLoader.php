<?php

require_once 'DBConnection.php';


class UnityDBLoader {
    
    private DBConnection $con;
    
    
    public function __construct()
    {
        
        $this->con = new DBConnection();
    }
    
    
    public function GetLessons(): array
    {
        
        $query = $this->con->ExecuteSQL(
        "select lessons.Name, theory.Introduction,
            theory.Usage, theory.PracticeDescription, lang.Language
        from lessons
            join lessons_has_lessonsTheory as has on lessons.Id = has.Lessons_Id
            join lessonsTheory as theory on theory.Id = has.LessonsTheory_Id
            join languages as lang on lang.Id = theory.Languages_Id;");

        
        if(!$query->execute())
        {
            return array();
        }
        
        
        $rows = $query->fetchAll();
        
        
        $lessonsKeys = array();
        
        foreach ($rows as $lessonRow)
        {
            
            $name = $lessonRow["Name"];
            
            $theory = array("Introduction" => $lessonRow["Introduction"],
                "Usage" => $lessonRow["Usage"],
                "PracticeDescription" => $lessonRow["PracticeDescription"],
                "Language" => $lessonRow["Language"]);
            
            $lessonsKeys[$name]["Theory"][] = $theory;
        }
        
        
        $lessons = array();
        
        foreach (array_keys($lessonsKeys) as $key)
        {
            
            $lessons[] = array("NameOfLesson" => $key,
                "Theory" => $lessonsKeys[$key]["Theory"]);
        }
        
        
        return $lessons;
    }
    
    
    public function GetLearningModules(): array
    {
        
        $query = $this->con->ExecuteSQL(
                "select l.Name, m.ModuleName
                from lessons as l
                    join learningModules as m on l.LearningModules_Id = m.Id;");
        
        if(!$query->execute())
        {
            return array();
        }
        
        
        $rows = $query->fetchAll();
        
        
        $modulesKeys = array();
        
        foreach ($rows as $row)
        {
            $moduleName = $row["ModuleName"];
            
            $lessonName = $row["Name"];
            
            $modulesKeys[$moduleName]["Lessons"][] = $lessonName;  
        }
        
        
        $modules = array();
        
        foreach (array_keys($modulesKeys) as $key)
        {
            
            $modules[] = array("NameOfProgram" => $key,
                "Lessons" => $modulesKeys[$key]["Lessons"]);
        }
        
        
        return $modules;
    }
    
    
    public function GetStartingModule(): string
    {
        return "Physics";
    }
}
