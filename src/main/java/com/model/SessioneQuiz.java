package com.model;

import java.util.List;

public class SessioneQuiz {

	 private List<Domanda> questions;
	    private int currentQuestionIndex;
	    private int score;
	    private String difficulty;
	    private boolean isTrainingMode;
	    
	    public SessioneQuiz() {
	        this.currentQuestionIndex = 0;
	        this.score = 0;
	    }
	    
	    public boolean hasNextQuestion() {
	        return currentQuestionIndex < questions.size();
	    }
	    
	    public Domanda getCurrentQuestion() {
	        if (hasNextQuestion()) {
	            return questions.get(currentQuestionIndex);
	        }
	        return null;
	    }
	    
	    public void nextQuestion() {
	        currentQuestionIndex++;
	    }
	    
	    public void incrementScore() {
	        score++;
	    }
	    

	    public List<Domanda> getQuestions() { return questions; }
	    public void setQuestions(List<Domanda> questions) { this.questions = questions; }
	    
	    public int getCurrentQuestionIndex() { return currentQuestionIndex; }
	    public void setCurrentQuestionIndex(int currentQuestionIndex) { this.currentQuestionIndex = currentQuestionIndex; }
	    
	    public int getScore() { return score; }
	    public void setScore(int score) { this.score = score; }
	    
	    public String getDifficulty() { return difficulty; }
	    public void setDifficulty(String difficulty) { this.difficulty = difficulty; }
	    
	    public boolean isTrainingMode() { return isTrainingMode; }
	    public void setTrainingMode(boolean trainingMode) { isTrainingMode = trainingMode; }
	    
	    public int getTotalQuestions() { return questions != null ? questions.size() : 0; }
	}

