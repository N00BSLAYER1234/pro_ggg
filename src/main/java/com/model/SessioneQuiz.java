package com.model;

import java.util.List;

public class SessioneQuiz {

    private List<Domanda> questions;
    private int currentQuestionIndex;
    private int score;
    private String difficulty;
    private boolean isTrainingMode;
    
    private boolean calibrationCompleted;
    private String calibrationAnswer;
    
    public SessioneQuiz() {
        this.currentQuestionIndex = 0;
        this.score = 0;
        this.calibrationCompleted = false;
    }
    
    public boolean hasNext() {
        return currentQuestionIndex < questions.size();
    }
    
    public Domanda getCurrent() {
        if (hasNext()) {
            return questions.get(currentQuestionIndex);
        }
        return null;
    }
    
    public void next() {
        currentQuestionIndex++;
    }
    
    public void addScore() {
        score++;
    }
    
    public List<Domanda> getQuestions() { 
        return questions; 
    }
    
    public void setQuestions(List<Domanda> questions) { 
        this.questions = questions; 
    }
    
    public int getCurrentIndex() { 
        return currentQuestionIndex; 
    }
    
    public void setCurrentIndex(int currentQuestionIndex) { 
        this.currentQuestionIndex = currentQuestionIndex; 
    }
    
    public int getScore() { 
        return score; 
    }
    
    public void setScore(int score) { 
        this.score = score; 
    }
    
    public String getDifficulty() { 
        return difficulty; 
    }
    
    public void setDifficulty(String difficulty) { 
        this.difficulty = difficulty; 
    }
    
    public boolean isTraining() { 
        return isTrainingMode; 
    }
    
    public void setTraining(boolean trainingMode) { 
        isTrainingMode = trainingMode; 
    }
    
    public int getTotal() { 
        return questions != null ? questions.size() : 0; 
    }
    

    public boolean isDone() {
        return calibrationCompleted;
    }
    
    public void setDone(boolean calibrationCompleted) {
        this.calibrationCompleted = calibrationCompleted;
    }
    
    public String getAnswer() {
        return calibrationAnswer;
    }
    
    public void setAnswer(String calibrationAnswer) {
        this.calibrationAnswer = calibrationAnswer;
    }
    

    public boolean wasCalibrated() {
        return calibrationCompleted && "Rome".equals(calibrationAnswer);
    }
}