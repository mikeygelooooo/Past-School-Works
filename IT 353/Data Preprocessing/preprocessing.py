import pandas as pd
import re
import string

# Load the dataset with error handling for problematic rows
file_path = 'semicleaned.csv'

# Use low-level error handling to drop problematic rows
valid_rows = []
with open(file_path, mode='r', encoding='utf-8', errors='replace') as file:
    for line in file:
        if "�" not in line:  # Skip lines with replacement characters indicating encoding issues
            valid_rows.append(line)

# Save valid rows to a temporary file for processing
temp_file_path = 'validated_dataset.csv'
with open(temp_file_path, mode='w', encoding='utf-8') as temp_file:
    temp_file.writelines(valid_rows)

# Reload the cleaned dataset
df = pd.read_csv(temp_file_path)

# Remove duplicates
df = df.drop_duplicates()

# Handle missing values
df = df.dropna()  # Drop rows with missing values (or use fillna for imputations)

# Standardize column names
df.columns = [col.strip().lower().replace(" ", "_") for col in df.columns]

# Ensure appropriate data types
if 'label' in df.columns:
    df['label'] = pd.to_numeric(df['label'], errors='coerce')

# Text cleaning function: retain only English letters and spaces
def clean_text(text):
    text = str(text).lower()  # Convert to lowercase
    text = re.sub(r"[^a-zA-Z\s]", "", text)  # Remove non-alphabetical characters
    text = re.sub(r'\s+', ' ', text).strip()  # Remove extra whitespaces
    return text

# Apply text cleaning to title and text columns
if 'title' in df.columns:
    df['title'] = df['title'].apply(clean_text)

if 'text' in df.columns:
    df['text'] = df['text'].apply(clean_text)

# Retain only necessary columns
relevant_columns = ['title', 'text', 'label']
df = df[relevant_columns]

# Confirm changes
print("Cleaned Dataframe Head:", df.head())
print("Data Types:", df.dtypes)

# Save cleaned dataset to a new file
output_path = 'cleaned_dataset.csv'
df.to_csv(output_path, index=False)
print(f"Cleaned dataset saved to {output_path}")
