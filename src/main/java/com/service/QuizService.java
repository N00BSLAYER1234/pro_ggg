package com.service;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.HashSet;
import java.util.List;
import java.util.Random;
import java.util.Set;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.entity.Country;
import com.model.Domanda;
import com.model.SessioneQuiz;
import com.repo.CountryRepo;

@Service
public class QuizService {

	@Autowired
    private CountryRepo countryRepository;
    
    private final Random random = new Random();
    
    public SessioneQuiz createQuizSession(String difficulty, boolean isTrainingMode) {
        SessioneQuiz session = new SessioneQuiz();
        session.setDifficulty(difficulty);
        session.setTrainingMode(isTrainingMode);
        
        int questionCount = getQuestionCount(difficulty);
        List<Domanda> questions = generateQuestions(questionCount, difficulty);
        session.setQuestions(questions);
        
        return session;
    }
    
    private int getQuestionCount(String difficulty) {
        return switch (difficulty.toLowerCase()) {
            case "easy" -> 5;
            case "medium" -> 10;
            case "hard" -> 15;
            default -> 10;
        };
    }
    
    private List<Domanda> generateQuestions(int count, String difficulty) {
        List<Domanda> questions = new ArrayList<>();
        List<Country> countries = countryRepository.findCountriesWithCapital();
        
        if (countries.size() < 3) {
            checkDataAvailability();
        }
        
        Collections.shuffle(countries);
        
        for (int i = 0; i < Math.min(count, countries.size()); i++) {
            Country country = countries.get(i);
            Domanda question = createCapitalQuestion(country, countries, difficulty);
            if (question != null) {
                questions.add(question);
            }
        }
        
        return questions;
    }
    
    private Domanda createCapitalQuestion(Country correctCountry, List<Country> allCountries, String difficulty) {
        if (correctCountry.getCapital() == null || correctCountry.getCapital().isEmpty()) {
            return null;
        }
        
        String questionText = "What is the capital of " + correctCountry.getName() + "?";
        String correctAnswer = correctCountry.getCapital();
        
        List<String> options = new ArrayList<>();
        options.add(correctAnswer);
        int optionCount = getOptionCount(difficulty);
        Set<String> usedCapitals = new HashSet<>();
        usedCapitals.add(correctAnswer);
        
        Collections.shuffle(allCountries);
        for (Country country : allCountries) {
            if (options.size() >= optionCount) break;
            if (country.getCapital() != null && !usedCapitals.contains(country.getCapital())) {
                options.add(country.getCapital());
                usedCapitals.add(country.getCapital());
            }
        }
        
        Collections.shuffle(options);
        Domanda question = new Domanda(questionText, correctAnswer, options, "capital");
        question.setCountryCode(correctCountry.getAlpha2Code()); 
        question.setCountryName(correctCountry.getName());
        return question;
    }
    private int getOptionCount(String difficulty) {
        return switch (difficulty.toLowerCase()) {
            case "facile" -> 3;
            case "medio" -> 4;
             case "difficile" -> 5;
            default -> 3;
        };
    }
    
    public boolean checkAnswer(String userAnswer, String correctAnswer) {
        return userAnswer != null && userAnswer
        		.trim()
        		.equalsIgnoreCase(correctAnswer.trim());
    }
    
    public List<Country> getAllCountriesForTraining() {
        return countryRepository.findAll();
    }
    
    private void checkDataAvailability() {
        long count = countryRepository.count();
        if (count == 0) {
            throw new RuntimeException("PASSA DA H2 PER RI-CARICARE I DATI");
        }
    }
}
