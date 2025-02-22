from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
from sklearn.metrics.pairwise import cosine_similarity
import numpy as np

# Load saved models
with open("tfidf_vectorizer0.pkl", "rb") as file:
    tfidf = pickle.load(file)

with open("vector_matrix0.pkl", "rb") as file:
    vector_matrix = pickle.load(file)

with open("job_data.pkl", "rb") as file:
    jobs_df = pickle.load(file)

app = Flask(__name__)
CORS(app)  # Enable CORS for Laravel API to communicate



@app.route('/recommend', methods=['POST'])
def recommend_jobs():
    data = request.json
    user_skills = data.get("skills", "")
    user_industry = data.get("industry", "")
    user_functional_area = data.get("functional_area", "")

    if not user_skills or not user_industry or not user_functional_area:
        return jsonify({"error": "Missing input fields"}), 400

    # Combine user input
    user_input = f"{user_skills} {user_industry} {user_functional_area}"

    # Convert user input into vector
    user_vector = tfidf.transform([user_input])

    # Compute similarity
    user_similarity_scores = cosine_similarity(user_vector, vector_matrix)

    # Get top 5 recommendations
    sorted_indices = user_similarity_scores[0].argsort()[::-1][:5]

    recommendations = []
    for idx in sorted_indices:
        recommendations.append({
            "Job Title": jobs_df.iloc[idx]['Job Title'],
            "Industry": jobs_df.iloc[idx]['Industry'],
            "Functional Area": jobs_df.iloc[idx]['Functional Area'],
            "Role": jobs_df.iloc[idx]['Role'],  
            "Similarity Score": float(user_similarity_scores[0][idx])
        })

    return jsonify({"recommendations": recommendations})
# @app.route('/test', methods=['GET'])
# def test_api():
#     return jsonify({"message": "Hello, World!"})

if __name__ == '__main__':
    app.run(host="0.0.0.0", port=5000, debug=True)