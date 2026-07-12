FROM python:3.9-slim

WORKDIR /app

# Install system dependencies needed for OpenCV
RUN apt-get update && apt-get install -y \
    libgl1 \
    libglib2.0-0 \
    && rm -rf /var/lib/apt/lists/*

# Copy requirements and install
COPY requirements.txt .
RUN pip install --upgrade pip && \
    pip install --no-cache-dir -r requirements.txt

# Copy the rest of the application
COPY . .

# Expose target port
EXPOSE 8001

# Command to run the Flask application
CMD ["python", "app.py"]
