from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import pandas as pd

app = Flask(__name__)
CORS(app)  # Allows Laravel to access this API

# Load the trained model
model = joblib.load("job_rec_ai_model.py")  # Ensure this file exists

@app.route("/recommend", methods=["POST"])
def recommend():
    try:
        # Get input data from request
        data = request.json
        skills = data.get("skills")
        functional_area = data.get("functional_area")
        industry = data.get("industry")

        # Create DataFrame for prediction
        input_df = pd.DataFrame([[skills, functional_area, industry]], 
                                columns=["skills", "functional_area", "industry"])
        
        # Predict job recommendation
        prediction = model.predict(input_df)

        return jsonify({"recommended_job": prediction[0]})

    except Exception as e:
        return jsonify({"error": str(e)}), 400

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)