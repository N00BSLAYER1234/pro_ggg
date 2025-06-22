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
    
    public SessioneQuiz makeQuiz(String difficulty, boolean isTrainingMode) {
        SessioneQuiz session = new SessioneQuiz();
        session.setDifficulty(difficulty);
        session.setTraining(isTrainingMode);
        
        int questionCount = getCount(difficulty);
        List<Domanda> questions = makeQuestions(questionCount, difficulty);
        session.setQuestions(questions);
        
        return session;
    }
    
    private int getCount(String difficulty) {
        return switch (difficulty.toLowerCase()) {
            case "facile" -> 5;
            case "medio" -> 10;
            case "difficile" -> 15;
            default -> 10;
        };
    }
    
    private List<Domanda> makeQuestions(int count, String difficulty) {
        List<Domanda> questions = new ArrayList<>();
        List<Country> countries = countryRepository.findCountriesWithCapital();
        
        if (countries.size() < 3) {
            checkData();
        }
        
        Collections.shuffle(countries);
        
        for (int i = 0; i < Math.min(count, countries.size()); i++) {
            Country country = countries.get(i);
            Domanda question = makeCapitalQuestion(country, countries, difficulty);
            if (question != null) {
                questions.add(question);
            }
        }
        
        return questions;
    }
    
    private Domanda makeCapitalQuestion(Country correctCountry, List<Country> allCountries, String difficulty) {
        if (correctCountry.getCapital() == null || correctCountry.getCapital().isEmpty()) {
            return null;
        }
        
        String questionText = "What is the capital of " + correctCountry.getName() + "?";
        String correctAnswer = correctCountry.getCapital();
        
        List<String> options = new ArrayList<>();
        options.add(correctAnswer);
        int optionCount = getOptionsCount(difficulty);
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
        question.setCode(correctCountry.getAlpha2Code()); 
        question.setName(correctCountry.getName());
        return question;
    }
    private int getOptionsCount(String difficulty) {
        return switch (difficulty.toLowerCase()) {
            case "facile" -> 3;
            case "medio" -> 4;
             case "difficile" -> 5;
            default -> 3;
        };
    }
    
    public boolean check(String userAnswer, String correctAnswer) {
        return userAnswer != null && userAnswer
        		.trim()
        		.equalsIgnoreCase(correctAnswer.trim());
    }
    
    public List<Country> getAll() {
        return countryRepository.findAll();
    }
    
    private void checkData() {
       long count = countryRepository.count();
        if (count == 0) {
            throw new RuntimeException("PASSA DA H2 PER RI-CARICARE I DATI");
        }
    }
}