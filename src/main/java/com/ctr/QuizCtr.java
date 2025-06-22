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
	    public String startQuiz(@RequestParam String difficulty, 
	                           @RequestParam(required = false) boolean training,
	                           HttpSession session) {
	        SessioneQuiz quizSession = quizService.createQuizSession(difficulty, training);
	        session.setAttribute("quizSession", quizSession);
	        
	        if (training) {
	            return "redirect:/training";
	        } else {
	            return "redirect:/quiz";
	        }
	    }
	    
	    @GetMapping("/quiz")
	    public String showQuiz(Model model, HttpSession session) {
	        SessioneQuiz quizSession = (SessioneQuiz) session.getAttribute("quizSession");
	        
	        if (quizSession == null || !quizSession.hasNextQuestion()) {
	            return "redirect:/results";
	        }
	        
	        Domanda currentQuestion = quizSession.getCurrentQuestion();
	        model.addAttribute("question", currentQuestion);
	        model.addAttribute("questionNumber", quizSession.getCurrentQuestionIndex() + 1);
	        model.addAttribute("totalQuestions", quizSession.getTotalQuestions());
	        model.addAttribute("score", quizSession.getScore());
	        
	        return "quiz";
	    }
	    
	    @PostMapping("/submit-answer")
	    public String submitAnswer(@RequestParam String answer, HttpSession session) {
	        SessioneQuiz quizSession = (SessioneQuiz) session.getAttribute("quizSession");
	        
	        if (quizSession != null && quizSession.hasNextQuestion()) {
	            Domanda currentQuestion = quizSession.getCurrentQuestion();
	            boolean isCorrect = quizService.checkAnswer(answer, currentQuestion.getCorrectAnswer());
	            
	            if (isCorrect) {
	                quizSession.incrementScore();
	            }
	            
	            quizSession.nextQuestion();
	            session.setAttribute("quizSession", quizSession);
	        }
	        
	        return "redirect:/quiz";
	    }
	    
	    @GetMapping("/results")
	    public String showResults(Model model, HttpSession session) {
	        SessioneQuiz quizSession = (SessioneQuiz) session.getAttribute("quizSession");
	        
	        if (quizSession == null) {
	            return "redirect:/";
	        }
	        
	        model.addAttribute("score", quizSession.getScore());
	        model.addAttribute("totalQuestions", quizSession.getTotalQuestions());
	        model.addAttribute("percentage", (quizSession.getScore() * 100) / quizSession.getTotalQuestions());
	        
	        session.removeAttribute("quizSession");
	        return "results";
	    }
	    
	    @GetMapping("/training")
	    public String showTraining(Model model) {
	        List<Country> countries = quizService.getAllCountriesForTraining();
	        model.addAttribute("countries", countries);
	        return "training";
	    }
	
}
