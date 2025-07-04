# Generated by Django 5.1.4 on 2025-01-07 04:45

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Academy', '0008_subjectschangeslogs'),
    ]

    operations = [
        migrations.CreateModel(
            name='ClassChangesLogs',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('class_name', models.CharField(max_length=50)),
                ('action', models.CharField(max_length=50)),
                ('log_time', models.DateTimeField(auto_now_add=True)),
            ],
            options={
                'verbose_name': 'Class Changes Log',
                'verbose_name_plural': 'Class Changes Logs',
            },
        ),
    ]
