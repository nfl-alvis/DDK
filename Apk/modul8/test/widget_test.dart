import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';

import 'package:modul8/main.dart';

void main() {
  testWidgets('app boots into splash flow', (WidgetTester tester) async {
    await tester.pumpWidget(const MyApp());

    expect(find.byType(MaterialApp), findsOneWidget);
    expect(find.byType(Scaffold), findsOneWidget);
    expect(find.byType(CircularProgressIndicator), findsOneWidget);
  });
}
