package com.model;

import java.util.List;

import jakarta.persistence.Id;

public class Domanda {
	
	private String question;
    private String correctAnswer;
    private List<String> options;
    private String type; 
    private String countryCode; 
    private String countryName; 
    
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
    

    public String getQuestion() { return question; }
    public void setQuestion(String question) { this.question = question; }
    
    public String getCorrect() { return correctAnswer; }
    public void setCorrect(String correctAnswer) { this.correctAnswer = correctAnswer; }
    
    public List<String> getOptions() { return options; }
    public void setOptions(List<String> options) { this.options = options; }
    
    public String getType() { return type; }
    public void setType(String type) { this.type = type; }
    
    public String getCode() { return countryCode; }
    public void setCode(String countryCode) { this.countryCode = countryCode; }
    
    public String getName() { return countryName; }
    public void setName(String countryName) { this.countryName = countryName; }
}