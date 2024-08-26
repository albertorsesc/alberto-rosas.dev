---
title: "Building Laravel API using TDD"
slug: "building-laravel-api-using-tdd"
date: 2021-10-14
category: "Laravel"
excerpt: "In this blog post we'll start with the Basics on TDD in Laravel"
#image: /prezet/img/images-20240509210223449-768w.webp
tags:   
    - Laravel
    - TDD
    - Testing
---

Hi _Artisans_, my name is [Alberto Rosas](https://alberto-rosas.dev/), I've been enjoying Laravel for many years and one of the most useful and rewarding things I've learned is how to build proper test suites for my applications. It is awesome to see Testing being practiced more often among the Laravel community so in this blog post we'll start with the Basics on TDD in Laravel and continue with advance topics in other articles.

## Introduction

The purpose of this article is to show that TDD doesn't have to be hard or be a pain to include it as part of your workflow or your team's, you just need to understand where to start and what to test.

It didn't take me much time to adopt TDD as a habit and find the right workflow for me. Having a standard workflow is important; knowing what you'll do first in a typical project can help you create your own structure, organize things in a way that you know where everything lives in your app and standarize your personal/client projects a bit.

In other words, TDD helps you code faster and with confidence. I mentioned earlier that you need to understand what to test first and the reality is that it doesn't matter, tests we'll guide you towards the next so the only thing you need to truly undestand is the feature you want to test.


## Requirements

- Basic knowledge of the framework
- Fresh Laravel project

Anyways, let's just start.

## Context

Throughout this article and probably a series of articles I'll create an API for a Real estate app.

`properties` table:

- `id`: Primary Key
- `type`: string (we'll probably create a relationship with 'property_types' later.)
- `price`: unsigned integer
- `description`: text

When working with Laravel we usually follow a standard/convention which is to organize Controller actions in the 5 API methods:

- index
- store
- update
- delete

We'll work our way one by one and explain what are the things we're most interested in testing.

### Testing Index

Index method is usually used to return a specific Collection for a Model.

### What are we testing?:

- We have a named API endpoint for retrieving a collection of resources.
- Test that the response comes in the form of a collection.

Let's start by creating a test, open a terminal inside your Laravel project and run:

```bash
php artisan make:test Api/PropertiesTest
```
