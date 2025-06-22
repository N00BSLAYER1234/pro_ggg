package com.ctr;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.entity.Country;
import com.model.Domanda;
import com.model.SessioneQuiz;
import com.service.QuizService;

import jakarta.servlet.http.HttpSession;

@Controller
public class QuizCtr {
    
    @Autowired
    private QuizService quizService;
    
@GetMapping("/")
    public String home() {
        return "home";
    }
    
    @PostMapping("/start-quiz")
public String start(@RequestParam String difficulty, 
                           @RequestParam(required = false) boolean training,  HttpSession session) {
        SessioneQuiz quizSession = quizService.makeQuiz(difficulty, training);
        session.setAttribute("quizSession", quizSession);
        
        if (training) {
            return "redirect:/training";
        } else {
            return "redirect:/quiz";
        }
    }
    
    @PostMapping("/calibration")
     public String calibrate(@RequestParam String answer, HttpSession session) {
    	session.setAttribute("calibrationAnswer", answer);
          String difficulty;
        if ("Rome".equals(answer)) {
            difficulty = "difficile";
            session.setAttribute("calibrationMessage", 
                "Complimenti, divertiti con la difficoltà massima");
        } else if ("Turin".equals(answer)) {
            difficulty = "medio";
            session.setAttribute("calibrationMessage", 
                "L'unica risposta corretta, complimenti");
        } else {

            difficulty = "difficile";
            session.setAttribute("calibrationMessage", 
                "Complimenti, divertiti con la difficoltà massima");
        }
        SessioneQuiz quizSession = quizService.makeQuiz(difficulty, false);
        quizSession.setDone(true);
        quizSession.setAnswer(answer);
        session.setAttribute("quizSession", quizSession);
        
        return "redirect:/quiz";
    }
    
    @GetMapping("/quiz")
    public String showQuiz(Model model, HttpSession session) {
        SessioneQuiz quizSession = (SessioneQuiz) session.getAttribute("quizSession");
        
        	if (quizSession == null || !quizSession.hasNext()) {
            return "redirect:/results";
        }
        
        Domanda currentQuestion = quizSession.getCurrent();
      model.addAttribute("question", currentQuestion);
     	model.addAttribute("questionNumber", quizSession.getCurrentIndex() + 1);
        model.addAttribute("totalQuestions", quizSession.getTotal());
        model.addAttribute("score", quizSession.getScore());


        String calibrationMessage = (String) session.getAttribute("calibrationMessage");
        if (calibrationMessage != null) {
            model.addAttribute("calibrationMessage", calibrationMessage);
           session.removeAttribute("calibrationMessage"); 
        }      return "quiz";
    }
    
    @PostMapping("/submit-answer")
    public String submit(@RequestParam String answer, HttpSession session) {
        SessioneQuiz quizSession = (SessioneQuiz) session.getAttribute("quizSession");
        
        if (quizSession != null && quizSession.hasNext()) {
           Domanda currentQuestion = quizSession.getCurrent();
          boolean isCorrect = quizService.check(answer, currentQuestion.getCorrect());
            if (isCorrect) {
                quizSession.addScore();
            }
            
            quizSession.next();
            session.setAttribute("quizSession", quizSession);
        }
        return "redirect:/quiz";  }
    
    @GetMapping("/results")
    public String results(Model model, HttpSession session) {
       SessioneQuiz quizSession = (SessioneQuiz) session.getAttribute("quizSession");
        
        if (quizSession == null) {
        return "redirect:/";
        }
        
        model.addAttribute("score", quizSession.getScore());
        model.addAttribute("totalQuestions", quizSession.getTotal());
        model.addAttribute("percentage", (quizSession.getScore() * 100) / quizSession.getTotal());
        
        if (quizSession.isDone()) {
          model.addAttribute("calibrationAnswer", quizSession.getAnswer());
            model.addAttribute("calibrationCompleted", true);
        }
        session.removeAttribute("quizSession");
         return "results";
    }
    
    @GetMapping("/training")
    public String train(Model model) {
        List<Country> countries = quizService.getAll();
         model.addAttribute("countries", countries);
        return "training";
    }
}