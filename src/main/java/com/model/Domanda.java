package com.model;

import java.util.List;

import jakarta.persistence.Id;

public class Domanda {
	
	
	
	private String question;
    private String correctAnswer;
    private List<String> options;
    private String type; // "capital", "population", "region", etc.
    private String countryCode; // alpha2Code for flag display
    private String countryName; // country name for reference
    
    public Domanda() {}
    
    public Domanda(String question, String correctAnswer, List<String> options, String type) {
        this.question = question;
        this.correctAnswer = correctAnswer;
        this.options = options;
        this.type = type;
    }
    
    public String getFlagUrl() {
        return countryCode != null ? "/flags/" + countryCode.toLowerCase() + ".png" : null;
    }
    
    // Getters and Setters
    public String getQuestion() { return question; }
    public void setQuestion(String question) { this.question = question; }
    
    public String getCorrectAnswer() { return correctAnswer; }
    public void setCorrectAnswer(String correctAnswer) { this.correctAnswer = correctAnswer; }
    
    public List<String> getOptions() { return options; }
    public void setOptions(List<String> options) { this.options = options; }
    
    public String getType() { return type; }
    public void setType(String type) { this.type = type; }
    
    public String getCountryCode() { return countryCode; }
    public void setCountryCode(String countryCode) { this.countryCode = countryCode; }
    
    public String getCountryName() { return countryName; }
    public void setCountryName(String countryName) { this.countryName = countryName; }
}
	

